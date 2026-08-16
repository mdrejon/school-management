<?php

namespace Modules\Teacher\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\Academic\Models\AcademicClass;
use Modules\Academic\Models\Section;
use Modules\Academic\Models\Subject;
use Modules\Academic\Models\Exam;
use Modules\Student\Models\Student;
use Modules\Student\Models\ExamAttendance;

class ExamAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $classes = AcademicClass::all();
        $exams = Exam::all();
        
        $sections = [];
        if ($request->class_id) {
            $sections = Section::where('academic_class_id', $request->class_id)->get();
        } else {
            $sections = Section::all();
        }

        $subjects = Subject::all(); // Alternatively, filter by class_id if a relation exists
        
        $students = [];
        $attendances = [];
        
        if ($request->class_id && $request->section_id && $request->subject_id && $request->exam_id) {
            $students = Student::where('class_id', $request->class_id)
                ->where('section_id', $request->section_id)
                ->get();
                
            $attendances = ExamAttendance::where('class_id', $request->class_id)
                ->where('section_id', $request->section_id)
                ->where('subject_id', $request->subject_id)
                ->where('exam_id', $request->exam_id)
                ->get()
                ->keyBy('student_id');
        }
        
        return Inertia::render('Teacher/Attendance/Exam', [
            'classes' => $classes,
            'sections' => $sections,
            'subjects' => $subjects,
            'exams' => $exams,
            'students' => $students,
            'attendances' => $attendances,
            'filters' => $request->only('class_id', 'section_id', 'subject_id', 'exam_id'),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:academic_classes,id',
            'section_id' => 'required|exists:sections,id',
            'subject_id' => 'required|exists:subjects,id',
            'exam_id' => 'required|exists:exams,id',
            'attendances' => 'required|array',
            'attendances.*.student_id' => 'required|exists:students,id',
            'attendances.*.status' => 'required|in:present,absent',
        ]);

        foreach ($request->attendances as $attendanceData) {
            ExamAttendance::updateOrCreate(
                [
                    'student_id' => $attendanceData['student_id'],
                    'exam_id' => $request->exam_id,
                    'subject_id' => $request->subject_id,
                ],
                [
                    'class_id' => $request->class_id,
                    'section_id' => $request->section_id,
                    'status' => $attendanceData['status'],
                ]
            );
        }

        return redirect()->back()->with('success', 'Exam Attendance saved successfully.');
    }
}
