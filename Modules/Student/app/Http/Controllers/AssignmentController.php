<?php

namespace Modules\Student\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\Academic\Models\Assignment;
use Modules\Student\Models\AssignmentSubmission;
use Modules\Student\Models\Student;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = Student::where('user_id', auth()->id())->first();

        if (!$student) {
            abort(403, 'Student record not found.');
        }

        $assignments = Assignment::with(['subject', 'academicClass', 'section'])
            ->where('class_id', $student->class_id)
            ->where('section_id', $student->section_id)
            ->latest()
            ->paginate(50);

        return Inertia::render('Student/Assignment/Index', [
            'assignments' => $assignments
        ]);
    }

    /**
     * Display a listing of the submitted assignments.
     */
    public function submissions()
    {
        $student = Student::where('user_id', auth()->id())->first();

        if (!$student) {
            abort(403, 'Student record not found.');
        }

        $submissions = AssignmentSubmission::with(['assignment.subject', 'assignment.academicClass', 'assignment.section'])
            ->where('student_id', $student->id)
            ->latest()
            ->paginate(50);

        return Inertia::render('Student/Assignment/SubmitList', [
            'submissions' => $submissions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $student = Student::where('user_id', auth()->id())->first();

        if (!$student) {
            abort(403, 'Student record not found.');
        }

        $assignments = Assignment::with('subject')
            ->where('class_id', $student->class_id)
            ->where('section_id', $student->section_id)
            ->latest()
            ->get();

        return Inertia::render('Student/Assignment/Create', [
            'assignments' => $assignments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'assignment_id' => 'required|exists:assignments,id',
            'notes' => 'nullable|string',
            'files' => 'nullable|array',
            'files.*' => 'nullable|file|max:10240', // Max 10MB per file
        ]);

        $student = Student::where('user_id', auth()->id())->first();

        if (!$student) {
            abort(403, 'Student record not found.');
        }

        // Check if already submitted
        $existingSubmission = AssignmentSubmission::where('assignment_id', $request->assignment_id)
            ->where('student_id', $student->id)
            ->first();

        if ($existingSubmission) {
            return back()->with('error', 'You have already submitted this assignment.');
        }

        $uploadedFiles = [];
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                if ($file) {
                    $path = $file->store('assignments/submissions', 'public');
                    $uploadedFiles[] = [
                        'name' => $file->getClientOriginalName(),
                        'path' => $path
                    ];
                }
            }
        }

        AssignmentSubmission::create([
            'assignment_id' => $request->assignment_id,
            'student_id' => $student->id,
            'notes' => $request->notes,
            'files' => count($uploadedFiles) > 0 ? $uploadedFiles : null,
            'status' => 'submitted',
        ]);

        return redirect()->route('student.assignments.index')->with('success', 'Assignment submitted successfully.');
    }
}
