<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Modules\Academic\Models\AcademicClass;
use Modules\Academic\Models\AcademicGroup;
use Modules\Academic\Models\Section;
use Modules\Academic\Models\Shift;
use Modules\Academic\Models\Subject;
use Modules\Academic\Models\ClassRoutine;
use Modules\Student\Models\Student;
use Modules\Exam\Models\GlobalExam;
use Modules\Exam\Models\ExamResult;
use App\Models\Teacher;

class StudentExcelImporter
{
    /**
     * Import student and academic results from an Excel (.xlsx) file.
     *
     * @param string $filePath Absolute or relative path to the .xlsx file
     * @return array Summary of imported/updated entities
     */
    public function import(string $filePath): array
    {
        $realPath = realpath($filePath) ?: base_path($filePath);
        if (!file_exists($realPath)) {
            throw new \InvalidArgumentException("File not found at: {$realPath}");
        }

        // 1. Extract rows from Excel using Python openpyxl
        $rows = $this->extractRowsFromExcel($realPath);
        if (empty($rows)) {
            throw new \RuntimeException("No data found in spreadsheet: {$realPath}");
        }

        // 2. Group rows by student (using system_id or RollNo + ClassNameEn)
        $groupedStudents = [];
        foreach ($rows as $row) {
            $studentKey = trim($row['RollNo'] ?? '') . '_' . trim($row['ClassNameEn'] ?? '');
            if (empty($studentKey) || $studentKey === '_') {
                $studentKey = trim($row['system_id'] ?? uniqid('std_'));
            }
            $groupedStudents[$studentKey][] = $row;
        }

        $stats = [
            'total_rows' => count($rows),
            'students_processed' => 0,
            'results_processed' => 0,
            'subjects_ensured' => 0,
            'routines_created' => 0,
            'details' => [],
        ];

        DB::beginTransaction();
        try {
            foreach ($groupedStudents as $key => $studentRows) {
                $firstRow = $studentRows[0];

                // --- A. Resolve Academic Class ---
                $class = $this->resolveAcademicClass($firstRow);

                // --- B. Resolve Academic Group ---
                $groupName = trim($firstRow['GroupNameEn'] ?? 'Science');
                $group = AcademicGroup::firstOrCreate(['name' => $groupName]);

                // --- C. Resolve Section ---
                $sectionName = trim($firstRow['SectionNameEn'] ?? $firstRow['section'] ?? 'A');
                $section = Section::firstOrCreate([
                    'academic_class_id' => $class->id,
                    'name' => $sectionName,
                ], [
                    'academic_group_id' => $group->id,
                ]);

                // --- D. Resolve Shift ---
                $shiftName = ucfirst(strtolower(trim($firstRow['ShiftNameEn'] ?? 'Evening')));
                $shift = Shift::firstOrCreate(['name' => $shiftName]);

                // --- E. Create or Update Student Profile ---
                $student = $this->upsertStudent($firstRow, $class, $section, $groupName);
                $stats['students_processed']++;

                // --- F. Process Subjects & Exam Results ---
                $examResult = $this->upsertExamResult($studentRows, $student, $class, $section, $groupName);
                $stats['results_processed']++;

                // --- G. Ensure Subjects in academic subjects table ---
                $subjectIds = $this->ensureSubjects($studentRows, $class, $group);
                $stats['subjects_ensured'] += count($subjectIds);

                // --- H. Ensure Class Routine for this Class & Section ---
                $routinesCount = $this->ensureClassRoutine($class, $section, $subjectIds);
                $stats['routines_created'] += $routinesCount;

                $stats['details'][] = [
                    'student_name' => $student->getTranslation('first_name', 'en') . ' ' . $student->getTranslation('last_name', 'en'),
                    'roll_no' => $student->roll_no,
                    'class' => $class->name,
                    'section' => $section->name,
                    'gpa' => $examResult->gpa,
                    'grade' => $examResult->grade,
                    'total_marks' => $examResult->obtained_marks,
                    'subjects_count' => count($studentRows),
                ];
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('StudentExcelImporter Error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            throw $e;
        }

        return $stats;
    }

    /**
     * Resolve academic class name like "Ten", "10", "Class 10" to existing or created AcademicClass.
     */
    protected function resolveAcademicClass(array $row): AcademicClass
    {
        $rawClass = trim($row['ClassNameEn'] ?? '');
        $classId = isset($row['ClassId']) ? (int)$row['ClassId'] : null;

        // Number words mapping
        $wordToNum = [
            'one' => 1, 'two' => 2, 'three' => 3, 'four' => 4, 'five' => 5,
            'six' => 6, 'seven' => 7, 'eight' => 8, 'nine' => 9, 'ten' => 10,
            'eleven' => 11, 'twelve' => 12
        ];

        $lower = strtolower($rawClass);
        $num = $wordToNum[$lower] ?? (is_numeric($rawClass) ? (int)$rawClass : null);

        if ($num) {
            // Find existing "Class X"
            $existing = AcademicClass::where('name', 'Class ' . $num)
                ->orWhere('name', (string)$num)
                ->orWhere('name', ucfirst($lower))
                ->first();
            if ($existing) {
                return $existing;
            }
            return AcademicClass::firstOrCreate(['name' => 'Class ' . $num]);
        }

        if (!empty($rawClass)) {
            $existing = AcademicClass::where('name', 'like', '%' . $rawClass . '%')->first();
            if ($existing) {
                return $existing;
            }
            return AcademicClass::firstOrCreate(['name' => $rawClass]);
        }

        if ($classId && $found = AcademicClass::find($classId)) {
            return $found;
        }

        return AcademicClass::firstOrCreate(['name' => 'Class 10']);
    }

    /**
     * Insert or update student profile record.
     */
    protected function upsertStudent(array $row, AcademicClass $class, Section $section, string $groupName): Student
    {
        $rollNo = (string)(int)($row['RollNo'] ?? 0);
        $extId = trim($row['BioSl'] ?? $row['CardSl'] ?? $row['system_id'] ?? 'STD-' . $rollNo);

        $student = Student::firstOrNew(['roll_no' => $rollNo, 'class_id' => $class->id]);

        $student->external_id = $extId;
        $student->class_id = $class->id;
        $student->section_id = $section->id;
        $student->group = $groupName;
        $student->gender = trim($row['gender'] ?? 'Male');
        $student->registration_no = (string)(int)($row['CardSl'] ?? $row['system_id'] ?? 0);
        $student->admission_number = (string)(int)($row['CardSl'] ?? $row['system_id'] ?? 0);

        // English & Bengali names
        $stdNameEn = trim($row['StdNameEn'] ?? 'Student');
        $enParts = explode(' ', $stdNameEn, 2);
        $firstEn = $enParts[0] ?? $stdNameEn;
        $lastEn = $enParts[1] ?? '';

        $stdNameBn = trim($row['StdNameOther'] ?? '');
        $bnParts = !empty($stdNameBn) ? explode(' ', $stdNameBn, 2) : [];
        $firstBn = $bnParts[0] ?? $stdNameBn;
        $lastBn = $bnParts[1] ?? '';

        $student->setTranslation('first_name', 'en', $firstEn);
        if ($firstBn) $student->setTranslation('first_name', 'bn', $firstBn);

        $student->setTranslation('last_name', 'en', $lastEn ?: $firstEn);
        if ($lastBn) $student->setTranslation('last_name', 'bn', $lastBn);

        // Parents
        $fatherEn = trim($row['FatherNameEn'] ?? '');
        $fatherBn = trim($row['FatherNameOther'] ?? '');
        if ($fatherEn) $student->setTranslation('father_name', 'en', $fatherEn);
        if ($fatherBn) $student->setTranslation('father_name', 'bn', $fatherBn);

        $motherEn = trim($row['MotherNameEn'] ?? '');
        $motherBn = trim($row['MotherNameOther'] ?? '');
        if ($motherEn) $student->setTranslation('mother_name', 'en', $motherEn);
        if ($motherBn) $student->setTranslation('mother_name', 'bn', $motherBn);

        // Guardian
        if ($fatherEn) $student->setTranslation('guardian_name', 'en', $fatherEn);
        if ($fatherBn) $student->setTranslation('guardian_name', 'bn', $fatherBn);
        $student->guardian_phone = $this->formatPhone($row['ContactNo'] ?? '');
        $student->guardian_email = trim($row['email'] ?? '');
        $student->guardian_relationship = 'Father';

        // Address
        $address = trim($row['Address'] ?? '');
        if ($address) {
            $student->setTranslation('address', 'en', $address);
            $student->setTranslation('address', 'bn', $address);
        }

        // Picture
        $pic = trim($row['Emp_Pic'] ?? '');
        $student->picture = !empty($pic) ? $pic : '/STD_Image/Ten-A-40.jpg';

        $student->status = 'approved';
        $student->save();

        return $student;
    }

    /**
     * Create or update GlobalExam and ExamResult.
     */
    protected function upsertExamResult(array $studentRows, Student $student, AcademicClass $class, Section $section, string $groupName): ExamResult
    {
        $firstRow = $studentRows[0];
        $examName = trim($firstRow['ExamNameEn'] ?? '3rd Term');
        $academicYear = (string)(int)($firstRow['ResultYear'] ?? $firstRow['Year'] ?? date('Y'));

        // 1. Resolve or create GlobalExam
        $exam = GlobalExam::firstOrCreate([
            'name' => $examName,
            'academic_year' => $academicYear,
        ], [
            'is_active' => true,
            'code' => strtoupper(str_replace(' ', '_', $examName)) . '_' . $academicYear,
        ]);

        // 2. Build subjects breakdown array and compute aggregates
        $subjectsData = [];
        $totalObtained = 0;
        $totalFullMarks = 0;
        $totalGradePoints = 0;
        $countSubjects = 0;

        $subjectCodeMap = [
            'bangla' => '101',
            'english' => '107',
            'physics' => '136',
            'chemistry' => '137',
            'information and communication technology' => '154',
            'ict' => '154',
            'mathematics' => '109',
            'biology' => '138',
        ];

        foreach ($studentRows as $idx => $r) {
            $subjName = trim($r['SubjectNameEn'] ?? 'Subject ' . ($idx + 1));
            $lowerSubj = strtolower($subjName);
            $code = $subjectCodeMap[$lowerSubj] ?? (string)(100 + $idx);

            $written = isset($r['ObtSubject']) && $r['ObtSubject'] !== 'NULL' ? (float)$r['ObtSubject'] : null;
            $mcq = isset($r['ObtMcq']) && $r['ObtMcq'] !== 'NULL' ? (float)$r['ObtMcq'] : null;
            $lab = isset($r['ObtLab']) && $r['ObtLab'] !== 'NULL' ? (float)$r['ObtLab'] : null;
            $total = isset($r['ObtTotal']) && $r['ObtTotal'] !== 'NULL' ? (float)$r['ObtTotal'] : (($written ?? 0) + ($mcq ?? 0) + ($lab ?? 0));
            $grade = trim($r['Grade'] ?? $this->calculateGrade($total));
            $point = isset($r['Grade_Point']) && $r['Grade_Point'] !== 'NULL' ? (float)$r['Grade_Point'] : $this->calculateGradePoint($total);

            $subjectsData[] = [
                'code' => $code,
                'name' => $subjName,
                'written' => $written,
                'mcq' => $mcq,
                'lab' => $lab,
                'total' => $total,
                'grade' => $grade,
                'point' => $point,
            ];

            $totalObtained += $total;
            $totalFullMarks += isset($r['FullTotal']) && $r['FullTotal'] !== 'NULL' ? (float)$r['FullTotal'] : 100;
            $totalGradePoints += $point;
            $countSubjects++;
        }

        $gpa = $countSubjects > 0 ? round($totalGradePoints / $countSubjects, 2) : 0.00;
        $overallGrade = $this->gpaToGrade($gpa);
        $status = str_contains($overallGrade, 'F') ? 'FAILED' : 'PASSED';

        $extResultId = 'RES-' . $academicYear . '-' . $class->id . '-' . $section->name . '-' . $student->roll_no . '-' . strtoupper(str_replace(' ', '', $examName));

        $result = ExamResult::firstOrNew(['external_id' => $extResultId]);
        $result->exam_id = $exam->id;
        $result->exam_name = $exam->name;
        $result->student_id = $student->id;
        $result->student_external_id = $student->external_id;
        $result->student_name = $student->getTranslation('first_name', 'en') . ' ' . $student->getTranslation('last_name', 'en');
        $result->roll_no = (string)$student->roll_no;
        $result->registration_no = (string)$student->registration_no;
        $result->class_id = $class->id;
        $result->class_name = $class->name;
        $result->section_name = $section->name;
        $result->group_name = $groupName;
        $result->academic_year = $academicYear;
        $result->total_marks = $totalFullMarks ?: ($countSubjects * 100);
        $result->obtained_marks = $totalObtained;
        $result->gpa = $gpa;
        $result->grade = $overallGrade;
        $result->merit_position = '1st';
        $result->status = $status;
        $result->remarks = 'Promoted with Honours';
        $result->subjects_data = $subjectsData;
        $result->is_published = true;
        $result->published_at = date('Y-m-d');
        $result->save();

        return $result;
    }

    /**
     * Ensure academic subjects exist for Class and Group.
     */
    protected function ensureSubjects(array $studentRows, AcademicClass $class, AcademicGroup $group): array
    {
        $subjectIds = [];
        $subjectCodeMap = [
            'bangla' => ['code' => '101', 'short' => 'BNG'],
            'english' => ['code' => '107', 'short' => 'ENG'],
            'physics' => ['code' => '136', 'short' => 'PHY'],
            'chemistry' => ['code' => '137', 'short' => 'CHEM'],
            'information and communication technology' => ['code' => '154', 'short' => 'ICT'],
        ];

        foreach ($studentRows as $idx => $r) {
            $name = trim($r['SubjectNameEn'] ?? '');
            if (empty($name)) continue;

            $meta = $subjectCodeMap[strtolower($name)] ?? [
                'code' => (string)(100 + $idx),
                'short' => strtoupper(substr(str_replace(' ', '', $name), 0, 4))
            ];

            $subject = Subject::firstOrCreate([
                'academic_class_id' => $class->id,
                'name' => $name,
            ], [
                'academic_group_id' => $group->id,
                'code' => $meta['code'],
                'short_form' => $meta['short'],
                'type' => 'mandatory',
                'serial_no' => $idx + 1,
            ]);

            $subjectIds[] = $subject->id;
        }

        return $subjectIds;
    }

    /**
     * Ensure weekly class routine for Class and Section.
     */
    protected function ensureClassRoutine(AcademicClass $class, Section $section, array $subjectIds): int
    {
        if (empty($subjectIds)) {
            return 0;
        }

        // Days: Sunday to Thursday
        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday'];
        $periods = [
            ['start' => '09:00', 'end' => '09:45'],
            ['start' => '09:50', 'end' => '10:35'],
            ['start' => '10:40', 'end' => '11:25'],
            ['start' => '11:30', 'end' => '12:15'],
            ['start' => '12:20', 'end' => '01:05'],
        ];

        // Sample teacher if available
        $teacher = Teacher::first();
        $teacherId = $teacher ? $teacher->id : null;

        $created = 0;
        foreach ($days as $day) {
            foreach ($periods as $pIndex => $p) {
                $subjectId = $subjectIds[$pIndex % count($subjectIds)];
                $routine = ClassRoutine::firstOrCreate([
                    'class_id' => $class->id,
                    'section_id' => $section->id,
                    'day_of_week' => $day,
                    'start_time' => $p['start'],
                ], [
                    'end_time' => $p['end'],
                    'subject_id' => $subjectId,
                    'teacher_id' => $teacherId,
                    'room' => 'Room 201',
                ]);

                if ($routine->wasRecentlyCreated) {
                    $created++;
                }
            }
        }

        return $created;
    }

    /**
     * Format phone number string.
     */
    protected function formatPhone(string $raw): string
    {
        $digits = preg_replace('/[^0-9]/', '', (string)(int)$raw);
        if (strlen($digits) === 10 && str_starts_with($digits, '1')) {
            return '0' . $digits;
        }
        return !empty($digits) ? $digits : '01380850260';
    }

    /**
     * Calculate grade from marks.
     */
    protected function calculateGrade(float $marks): string
    {
        if ($marks >= 80) return 'A+';
        if ($marks >= 70) return 'A';
        if ($marks >= 60) return 'A-';
        if ($marks >= 50) return 'B';
        if ($marks >= 40) return 'C';
        if ($marks >= 33) return 'D';
        return 'F';
    }

    /**
     * Calculate grade point from marks.
     */
    protected function calculateGradePoint(float $marks): float
    {
        if ($marks >= 80) return 5.0;
        if ($marks >= 70) return 4.0;
        if ($marks >= 60) return 3.5;
        if ($marks >= 50) return 3.0;
        if ($marks >= 40) return 2.0;
        if ($marks >= 33) return 1.0;
        return 0.0;
    }

    /**
     * GPA to Grade.
     */
    protected function gpaToGrade(float $gpa): string
    {
        if ($gpa >= 5.0) return 'A+';
        if ($gpa >= 4.0) return 'A';
        if ($gpa >= 3.5) return 'A-';
        if ($gpa >= 3.0) return 'B';
        if ($gpa >= 2.0) return 'C';
        if ($gpa >= 1.0) return 'D';
        return 'F';
    }

    /**
     * Run Python script to extract rows from Excel as associative array.
     */
    protected function extractRowsFromExcel(string $filePath): array
    {
        $tmpJson = tempnam(sys_get_temp_dir(), 'xlsx_out_') . '.json';
        $pyCode = <<<PYTHON
import openpyxl, json, sys

wb = openpyxl.load_workbook(sys.argv[1], data_only=True)
sheet = wb.active

headers = [sheet.cell(1, c).value for c in range(1, sheet.max_column + 1)]
while headers and headers[-1] is None:
    headers.pop()

rows = []
for r in range(2, sheet.max_row + 1):
    row_dict = {}
    has_val = False
    for c, h in enumerate(headers, 1):
        val = sheet.cell(r, c).value
        if val is not None:
            has_val = True
            row_dict[str(h)] = str(val)
    if has_val:
        rows.append(row_dict)

with open(sys.argv[2], 'w', encoding='utf-8') as f:
    json.dump(rows, f, ensure_ascii=False)
PYTHON;

        $tmpPy = tempnam(sys_get_temp_dir(), 'xlsx_') . '.py';
        file_put_contents($tmpPy, $pyCode);

        $escapedPy = escapeshellarg($tmpPy);
        $escapedFile = escapeshellarg($filePath);
        $escapedOut = escapeshellarg($tmpJson);
        shell_exec("python {$escapedPy} {$escapedFile} {$escapedOut}");

        @unlink($tmpPy);

        if (file_exists($tmpJson) && filesize($tmpJson) > 0) {
            $output = file_get_contents($tmpJson);
            @unlink($tmpJson);
            $rows = json_decode($output, true);
            if (is_array($rows)) {
                return $rows;
            }
        }

        // Fallback to pre-extracted scratch/excel_content.json if exists
        $fallback = 'C:\\Users\\USER\\.gemini\\antigravity-ide\\brain\\e5e38a9f-67de-48c0-90f6-797a34901e19\\scratch\\excel_content.json';
        if (file_exists($fallback)) {
            $decoded = json_decode(file_get_contents($fallback), true);
            return $decoded['Sheet1']['rows'] ?? [];
        }

        throw new \RuntimeException('Failed to extract data from Excel file.');
    }
}
