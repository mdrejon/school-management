<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use App\Models\Notice;
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

class SoftwareDataImporter
{
    /**
     * Import structured software export data into the school management database.
     *
     * @param string|null $jsonPath Path to software_data.json
     * @return array Summary statistics
     */
    public function import(?string $jsonPath = null): array
    {
        $realPath = $jsonPath ? (realpath($jsonPath) ?: base_path($jsonPath)) : base_path('docs/software_data.json');
        
        if (!file_exists($realPath)) {
            // If json not yet created, generate it first from docs/software_data.md
            $this->ensureJsonGenerated();
        }

        $jsonContent = file_get_contents($realPath);
        $data = json_decode($jsonContent, true);

        if (!$data || !isset($data['students'])) {
            throw new \RuntimeException("Invalid software data JSON at: {$realPath}");
        }

        $stats = [
            'notices_imported' => 0,
            'students_imported' => 0,
            'results_imported' => 0,
            'routines_imported' => 0,
            'details' => [],
        ];

        DB::beginTransaction();
        try {
            // 1. Ingest Notice Data
            if (!empty($data['notice'])) {
                $notice = $this->upsertNotice($data['notice']);
                $stats['notices_imported']++;
            }

            // 2. Resolve Academic Structure
            $class = AcademicClass::firstOrCreate(['name' => 'Class 10']);
            $group = AcademicGroup::firstOrCreate(['name' => 'Science']);
            $section = Section::firstOrCreate([
                'academic_class_id' => $class->id,
                'name' => 'A',
            ], [
                'academic_group_id' => $group->id,
            ]);
            $shift = Shift::firstOrCreate(['name' => 'Evening']);

            // 3. Resolve / Create Subjects
            $subjectIds = $this->ensureSubjects($class, $group);

            // 4. Ingest Student Profiles
            $studentMap = [];
            foreach ($data['students'] as $stdData) {
                $student = $this->upsertStudent($stdData, $class, $section, $group->name);
                $studentMap[$stdData['roll_no']] = $student;
                $stats['students_imported']++;
            }

            // 5. Ingest Exam Results
            $exam = GlobalExam::firstOrCreate(
                ['name' => '3rd Term', 'academic_year' => '2026'],
                ['is_active' => true, 'code' => '3RD_TERM_2026']
            );

            // Ensure exam is active
            if (!$exam->is_active) {
                $exam->is_active = true;
                $exam->save();
            }

            foreach ($data['exam_results'] as $resData) {
                $roll = $resData['roll_no'];
                $student = $studentMap[$roll] ?? Student::where('class_id', $class->id)->where('roll_no', (string)$roll)->first();
                if ($student) {
                    $examResult = $this->upsertExamResult($resData, $student, $exam, $class, $section);
                    $stats['results_imported']++;
                    $stats['details'][] = [
                        'roll' => $roll,
                        'name' => $student->getTranslation('first_name', 'en') . ' ' . $student->getTranslation('last_name', 'en'),
                        'gpa' => $examResult->gpa,
                        'grade' => $examResult->grade,
                        'total' => $examResult->obtained_marks,
                    ];
                }
            }

            // 6. Ensure Class Routine
            $routinesCount = $this->ensureClassRoutine($class, $section, $subjectIds, $data['class_routine'] ?? []);
            $stats['routines_imported'] = $routinesCount;

            DB::commit();

            // Clear cache for marquee notice ticker
            Cache::forget('notices_marquee_8');
            Cache::forget('notices_marquee_5');

            return $stats;
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Software data import error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            throw $e;
        }
    }

    /**
     * Upsert Notice record.
     */
    protected function upsertNotice(array $noticeData): Notice
    {
        $extId = (string)($noticeData['system_id'] ?? 39);
        $slug = $noticeData['slug'] ?? 'notice-of-durga-puja-holiday';

        $notice = Notice::firstOrNew(['external_id' => $extId]);
        $notice->slug = $slug;
        $notice->setTranslation('title', 'en', $noticeData['title_en'] ?? 'Notice of Durga Puja Holiday');
        $notice->setTranslation('title', 'bn', $noticeData['title_bn'] ?? 'শারদীয় দুর্গাপূজা উপলক্ষে ছুটির নোটিশ');
        $notice->setTranslation('title', 'ar', $noticeData['title_ar'] ?? 'إشعار عطلة دورجا بوجا');

        $notice->setTranslation('description', 'en', $noticeData['description_en'] ?? 'Notice of Durga Puja Holiday 2026.');
        $notice->setTranslation('description', 'bn', $noticeData['description_bn'] ?? 'শারদীয় দুর্গাপূজা ২০২৬ উপলক্ষে শ্রেণি কার্যক্রম বন্ধ থাকবে।');
        $notice->setTranslation('description', 'ar', $noticeData['description_ar'] ?? 'إشعار عطلة دورجا بوجا 2026.');

        $notice->pdf = $noticeData['notice_path'] ?? 'Notice/Notice of Durga Puja Holiday_20261009112952.pdf';
        $notice->published_at = $noticeData['published_at'] ?? '2026-10-09';
        $notice->is_active = true;
        $notice->save();

        return $notice;
    }

    /**
     * Upsert Student profile.
     */
    protected function upsertStudent(array $data, AcademicClass $class, Section $section, string $groupName): Student
    {
        $rollNo = (string)(int)($data['roll_no'] ?? 0);
        $extId = (string)($data['system_id'] ?? 'STD-' . $rollNo);

        $student = Student::firstOrNew(['roll_no' => $rollNo, 'class_id' => $class->id]);

        $student->external_id = $extId;
        $student->class_id = $class->id;
        $student->section_id = $section->id;
        $student->group = $groupName;
        $student->gender = trim($data['gender'] ?? 'Male');
        $student->registration_no = $extId;
        $student->admission_number = $extId;

        // English Name
        $nameEn = trim($data['name_en'] ?? 'Student');
        $enParts = explode(' ', $nameEn, 2);
        $student->setTranslation('first_name', 'en', $enParts[0] ?? $nameEn);
        $student->setTranslation('last_name', 'en', $enParts[1] ?? $enParts[0]);

        // Bengali Name
        $nameBn = trim($data['name_bn'] ?? '');
        if (!empty($nameBn)) {
            $bnParts = explode(' ', $nameBn, 2);
            $student->setTranslation('first_name', 'bn', $bnParts[0] ?? $nameBn);
            $student->setTranslation('last_name', 'bn', $bnParts[1] ?? $bnParts[0]);
        }

        // Father Name
        $fEn = trim($data['father_name_en'] ?? '');
        $fBn = trim($data['father_name_bn'] ?? '');
        if ($fEn) $student->setTranslation('father_name', 'en', $fEn);
        if ($fBn) $student->setTranslation('father_name', 'bn', $fBn);

        // Mother Name
        $mEn = trim($data['mother_name_en'] ?? '');
        $mBn = trim($data['mother_name_bn'] ?? '');
        if ($mEn) $student->setTranslation('mother_name', 'en', $mEn);
        if ($mBn) $student->setTranslation('mother_name', 'bn', $mBn);

        // Guardian
        if ($fEn) $student->setTranslation('guardian_name', 'en', $fEn);
        if ($fBn) $student->setTranslation('guardian_name', 'bn', $fBn);
        $student->guardian_phone = trim($data['contact_no'] ?? '');
        $student->guardian_relationship = 'Father';

        // Address
        $address = trim($data['address'] ?? '');
        if ($address) {
            $student->setTranslation('address', 'en', $address);
            $student->setTranslation('guardian_address', 'en', $address);
        }

        // Picture
        $student->picture = $data['picture'] ?? "/STD_Image/Ten-A-{$rollNo}.jpg";
        $student->status = 1;
        $student->save();

        return $student;
    }

    /**
     * Upsert Exam Result for student.
     */
    protected function upsertExamResult(array $resData, Student $student, GlobalExam $exam, AcademicClass $class, Section $section): ExamResult
    {
        $roll = (string)$student->roll_no;
        $extResultId = "RES-2026-{$class->id}-{$section->name}-{$roll}-3RDTERM";

        $result = ExamResult::firstOrNew(['external_id' => $extResultId]);
        $result->exam_id = $exam->id;
        $result->exam_name = $exam->name;
        $result->student_id = $student->id;
        $result->student_external_id = $student->external_id;
        $result->student_name = $student->getTranslation('first_name', 'en') . ' ' . $student->getTranslation('last_name', 'en');
        $result->roll_no = $roll;
        $result->registration_no = (string)$student->registration_no;
        $result->class_id = $class->id;
        $result->class_name = $class->name;
        $result->section_name = $section->name;
        $result->group_name = 'Science';
        $result->academic_year = '2026';
        $result->total_marks = $resData['total_marks'] ?? 500;
        $result->obtained_marks = $resData['obtained_marks'] ?? 0;
        $result->gpa = $resData['gpa'] ?? 0.00;
        $result->grade = $resData['grade'] ?? 'F';
        $result->status = $resData['status'] ?? 'PASSED';
        $result->merit_position = $this->determineMerit((int)$roll);
        $result->remarks = 'Promoted with Honours';
        $result->subjects_data = $resData['subjects'] ?? [];
        $result->is_published = true;
        $result->published_at = date('Y-m-d');
        $result->save();

        return $result;
    }

    /**
     * Determine merit position label.
     */
    protected function determineMerit(int $roll): string
    {
        if ($roll === 1) return '1st';
        if ($roll === 2) return '2nd';
        if ($roll === 3) return '3rd';
        if ($roll === 4) return '4th';
        return $roll . 'th';
    }

    /**
     * Ensure academic subjects exist for Class 10 Science.
     */
    protected function ensureSubjects(AcademicClass $class, AcademicGroup $group): array
    {
        $subjectsConfig = [
            'Bangla' => ['code' => '101', 'short' => 'BNG', 'serial' => '1'],
            'English' => ['code' => '107', 'short' => 'ENG', 'serial' => '2'],
            'General Math' => ['code' => '109', 'short' => 'MATH', 'serial' => '3'],
            'Physics' => ['code' => '136', 'short' => 'PHY', 'serial' => '4'],
            'Information and Communication Technology' => ['code' => '154', 'short' => 'ICT', 'serial' => '5'],
        ];

        $subjectIds = [];
        foreach ($subjectsConfig as $name => $cfg) {
            $subject = Subject::firstOrCreate([
                'academic_class_id' => $class->id,
                'name' => $name,
            ], [
                'academic_group_id' => $group->id,
                'code' => $cfg['code'],
                'short_form' => $cfg['short'],
                'type' => 'mandatory',
                'serial_no' => $cfg['serial'],
            ]);
            $subjectIds[$name] = $subject->id;
        }

        return $subjectIds;
    }

    /**
     * Ensure weekly timetable for Class 10 Section A.
     */
    protected function ensureClassRoutine(AcademicClass $class, Section $section, array $subjectIds, array $routineData): int
    {
        $teachers = Teacher::where('is_active', true)->get();
        if ($teachers->isEmpty()) {
            $teachers = Teacher::all();
        }

        $teacherList = $teachers->pluck('id')->values()->all();
        $teacherCount = count($teacherList);

        $slots = !empty($routineData) ? $routineData : [
            ['day' => 'Sunday', 'time' => '09:00 AM - 09:45 AM', 'subject' => 'Bangla', 'room' => 'Room 201'],
            ['day' => 'Sunday', 'time' => '10:00 AM - 10:45 AM', 'subject' => 'English', 'room' => 'Room 201'],
            ['day' => 'Sunday', 'time' => '11:00 AM - 11:45 AM', 'subject' => 'General Math', 'room' => 'Room 201'],
            ['day' => 'Sunday', 'time' => '12:00 PM - 12:45 PM', 'subject' => 'Physics', 'room' => 'Science Lab 1'],
            ['day' => 'Sunday', 'time' => '01:30 PM - 02:15 PM', 'subject' => 'Information and Communication Technology', 'room' => 'Computer Lab'],
            ['day' => 'Monday', 'time' => '09:00 AM - 09:45 AM', 'subject' => 'English', 'room' => 'Room 201'],
            ['day' => 'Monday', 'time' => '10:00 AM - 10:45 AM', 'subject' => 'General Math', 'room' => 'Room 201'],
            ['day' => 'Monday', 'time' => '11:00 AM - 11:45 AM', 'subject' => 'Bangla', 'room' => 'Room 201'],
            ['day' => 'Monday', 'time' => '12:00 PM - 12:45 PM', 'subject' => 'Physics', 'room' => 'Science Lab 1'],
            ['day' => 'Monday', 'time' => '01:30 PM - 02:15 PM', 'subject' => 'Information and Communication Technology', 'room' => 'Computer Lab'],
            ['day' => 'Tuesday', 'time' => '09:00 AM - 09:45 AM', 'subject' => 'Bangla', 'room' => 'Room 201'],
            ['day' => 'Tuesday', 'time' => '10:00 AM - 10:45 AM', 'subject' => 'Physics', 'room' => 'Science Lab 1'],
            ['day' => 'Tuesday', 'time' => '11:00 AM - 11:45 AM', 'subject' => 'English', 'room' => 'Room 201'],
            ['day' => 'Tuesday', 'time' => '12:00 PM - 12:45 PM', 'subject' => 'General Math', 'room' => 'Room 201'],
            ['day' => 'Tuesday', 'time' => '01:30 PM - 02:15 PM', 'subject' => 'Information and Communication Technology', 'room' => 'Computer Lab'],
            ['day' => 'Wednesday', 'time' => '09:00 AM - 09:45 AM', 'subject' => 'General Math', 'room' => 'Room 201'],
            ['day' => 'Wednesday', 'time' => '10:00 AM - 10:45 AM', 'subject' => 'Bangla', 'room' => 'Room 201'],
            ['day' => 'Wednesday', 'time' => '11:00 AM - 11:45 AM', 'subject' => 'Physics', 'room' => 'Science Lab 1'],
            ['day' => 'Wednesday', 'time' => '12:00 PM - 12:45 PM', 'subject' => 'English', 'room' => 'Room 201'],
            ['day' => 'Wednesday', 'time' => '01:30 PM - 02:15 PM', 'subject' => 'Information and Communication Technology', 'room' => 'Computer Lab'],
            ['day' => 'Thursday', 'time' => '09:00 AM - 09:45 AM', 'subject' => 'Physics', 'room' => 'Science Lab 1'],
            ['day' => 'Thursday', 'time' => '10:00 AM - 10:45 AM', 'subject' => 'Information and Communication Technology', 'room' => 'Computer Lab'],
            ['day' => 'Thursday', 'time' => '11:00 AM - 11:45 AM', 'subject' => 'English', 'room' => 'Room 201'],
            ['day' => 'Thursday', 'time' => '12:00 PM - 12:45 PM', 'subject' => 'Bangla', 'room' => 'Room 201'],
            ['day' => 'Thursday', 'time' => '01:30 PM - 02:15 PM', 'subject' => 'General Math', 'room' => 'Room 201'],
        ];

        $count = 0;
        foreach ($slots as $idx => $slot) {
            $subjName = $slot['subject'];
            $subjId = $subjectIds[$subjName] ?? array_values($subjectIds)[0] ?? 1;
            $teacherId = $teacherCount > 0 ? $teacherList[$idx % $teacherCount] : null;

            $times = explode(' - ', $slot['time']);
            $startTime = isset($times[0]) ? date('H:i:s', strtotime($times[0])) : '09:00:00';
            $endTime = isset($times[1]) ? date('H:i:s', strtotime($times[1])) : '09:45:00';

            ClassRoutine::updateOrCreate([
                'class_id' => $class->id,
                'section_id' => $section->id,
                'day_of_week' => $slot['day'],
                'start_time' => $startTime,
            ], [
                'subject_id' => $subjId,
                'teacher_id' => $teacherId,
                'end_time' => $endTime,
                'room' => $slot['room'] ?? 'Room 201',
            ]);
            $count++;
        }

        return $count;
    }

    /**
     * Fallback to generate JSON if missing.
     */
    protected function ensureJsonGenerated(): void
    {
        $scriptPath = 'C:/Users/USER/.gemini/antigravity-ide/brain/e5e38a9f-67de-48c0-90f6-797a34901e19/scratch/generate_json.py';
        if (file_exists($scriptPath)) {
            shell_exec("python {$scriptPath}");
        }
    }
}
