<?php

namespace Modules\Academic\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Modules\Academic\Models\StudentOptionalSubject;
use Modules\Academic\Models\OptionalSubjectConfig;
use Modules\Academic\Models\Subject;
use Modules\Student\Models\Student;

class StudentOptionalSubjectController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Academic/StudentOptionalSubjects/Index', [
            'assignments' => StudentOptionalSubject::with(['student', 'optionalSubjectConfig', 'subject'])->latest()->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Academic/StudentOptionalSubjects/Form', [
            'students' => Student::select('id', 'first_name', 'last_name')->get(),
            'configs' => OptionalSubjectConfig::with('subjects')->get(),
            'subjects' => Subject::all(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'optional_subject_config_id' => 'required|exists:optional_subject_configs,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        StudentOptionalSubject::updateOrCreate(
            [
                'student_id' => $data['student_id'],
                'optional_subject_config_id' => $data['optional_subject_config_id'],
            ],
            [
                'subject_id' => $data['subject_id'],
            ]
        );

        return redirect()->route('admin.academic.student-optional-subjects.index')->with('success', 'Optional subject assigned successfully.');
    }

    public function destroy(StudentOptionalSubject $studentOptionalSubject)
    {
        $studentOptionalSubject->delete();
        return back()->with('success', 'Assignment removed successfully.');
    }
}
