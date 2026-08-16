<?php

namespace Modules\Exam\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\Academic\Models\AcademicClass;
use Modules\Exam\Models\GlobalExam;
use Modules\Exam\Models\GlobalExamGrade;
use Modules\Exam\Models\ExamStudentMark;
use Modules\Student\Models\Student;
use Modules\Academic\Models\Subject;

class ExamResultController extends Controller
{
    public function index()
    {
        $classes = AcademicClass::all();
        $exams = GlobalExam::all();
        $subjects = Subject::all();
        
        return Inertia::render('Teacher/Exam/ExamResult/Index', [
            'classes' => $classes,
            'exams' => $exams,
            'subjects' => $subjects,
        ]);
    }

    public function fetchResults(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'exam_id' => 'required',
            'subject_id' => 'nullable',
        ]);

        $query = ExamStudentMark::with(['student', 'exam', 'examMark'])
            ->where('class_id', $request->class_id)
            ->where('exam_id', $request->exam_id);

        if ($request->subject_id) {
            $query->where('subject_id', $request->subject_id);
        }

        $marks = $query->get();
        $grades = GlobalExamGrade::all();

        $results = [];

        foreach ($marks as $mark) {
            $studentId = $mark->student_id;
            $subjectId = $mark->subject_id;
            $key = $studentId . '_' . $subjectId;

            if (!isset($results[$key])) {
                $results[$key] = [
                    'student_id' => $mark->student->id ?? '',
                    'roll_no' => $mark->student->roll_no ?? '',
                    'name' => ($mark->student->first_name ?? '') . ' ' . ($mark->student->last_name ?? ''),
                    'subject_name' => \Modules\Academic\Models\Subject::find($subjectId)->name ?? 'Unknown',
                    'exam_name' => $mark->exam->name ?? 'Unknown',
                    'total_marks' => 0,
                    'grade_point' => '0.00',
                    'grade' => 'F',
                ];
            }

            $results[$key]['total_marks'] += $mark->marks_obtained;
        }

        foreach ($results as &$result) {
            $total = $result['total_marks'];
            $gradeAssigned = false;
            foreach ($grades as $g) {
                $parts = explode('-', $g->grade_range);
                if (count($parts) == 2) {
                    $min = (float) trim($parts[0]);
                    $max = (float) trim($parts[1]);
                    if ($total >= $min && $total <= $max) {
                        $result['grade'] = $g->grade;
                        if ($g->grade == 'A+') $result['grade_point'] = '5.00';
                        elseif ($g->grade == 'A') $result['grade_point'] = '4.00';
                        elseif ($g->grade == 'A-') $result['grade_point'] = '3.50';
                        elseif ($g->grade == 'B') $result['grade_point'] = '3.00';
                        elseif ($g->grade == 'C') $result['grade_point'] = '2.00';
                        elseif ($g->grade == 'D') $result['grade_point'] = '1.00';
                        else $result['grade_point'] = '0.00';
                        $gradeAssigned = true;
                        break;
                    }
                }
            }
            if (!$gradeAssigned) {
                $result['grade'] = 'F';
                $result['grade_point'] = '0.00';
            }
        }

        return response()->json([
            'results' => array_values($results)
        ]);
    }
}
