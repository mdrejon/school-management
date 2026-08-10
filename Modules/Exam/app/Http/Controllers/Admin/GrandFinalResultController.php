<?php

namespace Modules\Exam\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\Academic\Models\AcademicClass;
use Modules\Academic\Models\Section;
use Modules\Exam\Models\GlobalExamGrade;
use Modules\Exam\Models\ExamStudentMark;
use Modules\Student\Models\Student;

class GrandFinalResultController extends Controller
{
    public function index()
    {
        $classes = AcademicClass::all();
        $sections = Section::all();
        
        return Inertia::render('Admin/Exam/GrandFinalResult/Index', [
            'classes' => $classes,
            'sections' => $sections,
        ]);
    }

    public function fetchResults(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'section_id' => 'nullable',
            'from_roll' => 'nullable|integer',
            'to_roll' => 'nullable|integer',
        ]);

        $query = Student::where('class_id', $request->class_id);

        if ($request->section_id) {
            $query->where('section_id', $request->section_id);
        }

        if ($request->from_roll) {
            $query->where('roll_no', '>=', $request->from_roll);
        }
        
        if ($request->to_roll) {
            $query->where('roll_no', '<=', $request->to_roll);
        }

        $students = $query->get();
        $studentIds = $students->pluck('id');

        // Fetch ALL marks for these students
        $marks = ExamStudentMark::whereIn('student_id', $studentIds)->get();
        $grades = GlobalExamGrade::all();

        $results = [];

        foreach ($students as $student) {
            $studentMarks = $marks->where('student_id', $student->id);
            $totalMarks = $studentMarks->sum('marks_obtained');

            $result = [
                'student_id' => $student->id,
                'roll_no' => $student->roll_no ?? '',
                'name' => ($student->first_name ?? '') . ' ' . ($student->last_name ?? ''),
                'total_marks' => $totalMarks,
                'grade_point' => '0.00',
                'grade' => 'F',
            ];

            // Assign Grade
            $gradeAssigned = false;
            foreach ($grades as $g) {
                $parts = explode('-', $g->grade_range);
                if (count($parts) == 2) {
                    $min = (float) trim($parts[0]);
                    $max = (float) trim($parts[1]);
                    if ($totalMarks >= $min && $totalMarks <= $max) {
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
            if (!$gradeAssigned && $totalMarks > 0) {
                // If total marks is exceptionally high (summed from multiple exams), it might exceed the normal 0-100 grade range.
                // For a proper 'Grand Final Result', grades should probably be based on averages, or the grade ranges need to support > 100.
                // Assuming simple fallback: if total marks > highest max, just give A+
                $maxPossible = 0;
                foreach ($grades as $g) {
                    $parts = explode('-', $g->grade_range);
                    if (count($parts) == 2) {
                        $max = (float) trim($parts[1]);
                        if ($max > $maxPossible) $maxPossible = $max;
                    }
                }
                if ($totalMarks > $maxPossible) {
                    $result['grade'] = 'A+';
                    $result['grade_point'] = '5.00';
                }
            }

            $results[] = $result;
        }

        return response()->json([
            'results' => $results
        ]);
    }
}
