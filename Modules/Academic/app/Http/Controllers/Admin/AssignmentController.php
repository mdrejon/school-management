<?php

namespace Modules\Academic\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\Academic\Models\AcademicClass;
use Modules\Academic\Models\Section;
use Modules\Academic\Models\AcademicSubject;
use Modules\Academic\Models\Assignment;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Assignment::with(['academicClass', 'section', 'subject', 'teacher'])->latest();
        
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        $perPage = $request->per_page ?: 50;
        $assignments = $query->paginate($perPage)->withQueryString();

        return Inertia::render('Admin/Academic/Assignment/Index', [
            'assignments' => $assignments,
            'filters' => $request->only('search', 'per_page'),
        ]);
    }

    public function create(Request $request)
    {
        $classes = AcademicClass::all();
        
        $sections = [];
        if ($request->class_id) {
            $sections = Section::where('academic_class_id', $request->class_id)->get();
        } else {
            $sections = Section::all();
        }

        $subjects = AcademicSubject::all();
        $teachers = User::role('staff')->get();

        return Inertia::render('Admin/Academic/Assignment/Create', [
            'classes' => $classes,
            'sections' => $sections,
            'subjects' => $subjects,
            'teachers' => $teachers,
            'filters' => $request->only('class_id'),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
            'class_id' => 'required|exists:academic_classes,id',
            'section_id' => 'required|exists:sections,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'nullable|exists:users,id',
            'files' => 'nullable|array|max:4',
            'files.*' => 'nullable|file|max:10240', // 10MB max per file
        ]);

        $filePaths = [];

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                if ($file) {
                    $path = $file->store('assignments', 'public');
                    $filePaths[] = $path;
                }
            }
        }

        Assignment::create([
            'teacher_id' => $request->teacher_id ?? auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'subject_id' => $request->subject_id,
            'files' => $filePaths,
        ]);

        return redirect()->route('admin.academic.assignments.index')->with('success', 'Assignment created successfully.');
    }

    public function destroy(Assignment $assignment)
    {
        if ($assignment->files) {
            foreach ($assignment->files as $file) {
                Storage::disk('public')->delete($file);
            }
        }
        
        $assignment->delete();

        return redirect()->route('admin.academic.assignments.index')->with('success', 'Assignment deleted successfully.');
    }
}
