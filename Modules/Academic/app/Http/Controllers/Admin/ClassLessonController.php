<?php

namespace Modules\Academic\Http\Controllers\Admin;

use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\Academic\Models\AcademicClass;
use Modules\Academic\Models\Section;
use Modules\Academic\Models\Subject;
use Modules\Academic\Models\ClassLesson;
use Illuminate\Support\Facades\Storage;

class ClassLessonController extends Controller
{
    public function index(Request $request)
    {
        $query = ClassLesson::with(['academicClass', 'section', 'subject', 'session'])->latest();
        
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        $perPage = $request->per_page ?: 10;
        $classLessons = $query->paginate($perPage)->withQueryString();

        return Inertia::render('Admin/Academic/ClassLesson/Index', [
            'classLessons' => $classLessons,
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

        $subjects = Subject::all();

        return Inertia::render('Admin/Academic/ClassLesson/Create', [
            'classes' => $classes,
            'sections' => $sections,
            'subjects' => $subjects,
            'filters' => $request->only('class_id'),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'class_id' => 'required|exists:academic_classes,id',
            'section_id' => 'required|exists:sections,id',
            'subject_id' => 'required|exists:subjects,id',
            'files' => 'nullable|array|max:4',
            'files.*' => 'nullable|file|max:20480', // 20MB max per file
        ]);

        $filePaths = [];

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                if ($file) {
                    $path = $file->store('class_lessons', 'public');
                    $filePaths[] = $path;
                }
            }
        }

        ClassLesson::create([
            'teacher_id' => $request->teacher_id ?? auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'subject_id' => $request->subject_id,
            'files' => $filePaths,
        ]);

        return redirect()->route('admin.academic.class-lessons.index')->with('success', 'Class lesson created successfully.');
    }

    public function destroy(ClassLesson $classLesson)
    {
        if ($classLesson->files) {
            foreach ($classLesson->files as $file) {
                Storage::disk('public')->delete($file);
            }
        }
        
        $classLesson->delete();

        return redirect()->route('admin.academic.class-lessons.index')->with('success', 'Class lesson deleted successfully.');
    }
}
