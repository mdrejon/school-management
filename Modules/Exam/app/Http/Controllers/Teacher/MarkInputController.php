<?php

namespace Modules\Exam\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\Academic\Models\AcademicClass;
use Modules\Academic\Models\AcademicGroup;
use Modules\Academic\Models\AcademicSubject;
use Modules\Exam\Models\GlobalExam;
use Modules\Exam\Models\ExamMark;
use Modules\Exam\Models\ExamStudentMark;
use Modules\Student\Models\Student;

class MarkInputController extends Controller
{
    public function index()
    {
        $classes = AcademicClass::with('sections')->get();
        return Inertia::render('Teacher/Exam/MarkInput/Index', [
            'classes' => $classes
        ]);
    }

    public function show($classId)
    {
        $class = AcademicClass::findOrFail($classId);
        $exams = GlobalExam::all();
        $groups = AcademicGroup::all();
        $subjects = AcademicSubject::all();
        $markConfigs = ExamMark::all();

        return Inertia::render('Teacher/Exam/MarkInput/Form', [
            'academicClass' => $class,
            'exams' => $exams,
            'groups' => $groups,
            'subjects' => $subjects,
            'markConfigs' => $markConfigs,
        ]);
    }

    public function fetchStudents(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'exam_id' => 'required',
            'group_id' => 'nullable',
            'subject_id' => 'required',
        ]);

        $query = Student::where('class_id', $request->class_id);
        
        if ($request->group_id) {
            $group = AcademicGroup::find($request->group_id);
            if ($group) {
                $query->where('group', $group->name);
            }
        }

        $students = $query->get();

        // Get existing marks
        $existingMarks = ExamStudentMark::where('class_id', $request->class_id)
            ->where('exam_id', $request->exam_id)
            ->where('subject_id', $request->subject_id)
            ->get()
            ->groupBy('student_id');

        return response()->json([
            'students' => $students,
            'existingMarks' => $existingMarks,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'exam_id' => 'required',
            'subject_id' => 'required',
            'marks' => 'required|array',
        ]);

        foreach ($request->marks as $studentId => $markConfigs) {
            foreach ($markConfigs as $markConfigId => $markValue) {
                ExamStudentMark::updateOrCreate(
                    [
                        'student_id' => $studentId,
                        'class_id' => $request->class_id,
                        'exam_id' => $request->exam_id,
                        'subject_id' => $request->subject_id,
                        'exam_mark_id' => $markConfigId,
                    ],
                    [
                        'marks_obtained' => $markValue ?: 0,
                    ]
                );
            }
        }

        return redirect()->back()->with('success', 'Marks saved successfully.');
    }
}
