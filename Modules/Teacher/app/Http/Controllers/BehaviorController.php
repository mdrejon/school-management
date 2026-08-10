<?php

namespace Modules\Teacher\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\Academic\Models\AcademicClass;
use Modules\Academic\Models\Section;
use Modules\Student\Models\Student;
use Modules\Academic\Models\Behavior;
use Illuminate\Support\Facades\Storage;

class BehaviorController extends Controller
{
    public function index(Request $request)
    {
        $query = Behavior::with(['academicClass', 'section', 'student'])->latest();
        
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('note', 'like', '%' . $request->search . '%');
        }

        $perPage = $request->per_page ?: 10;
        $behaviors = $query->paginate($perPage)->withQueryString();

        return Inertia::render('Teacher/Behavior/Index', [
            'behaviors' => $behaviors,
            'filters' => $request->only('search', 'per_page'),
        ]);
    }

    public function create(Request $request)
    {
        $classes = AcademicClass::all();
        
        $sections = [];
        if ($request->class_id) {
            $sections = Section::where('class_id', $request->class_id)->get();
        }

        $students = [];
        if ($request->class_id && $request->section_id) {
            $students = Student::where('class_id', $request->class_id)
                               ->where('section_id', $request->section_id)
                               ->get();
        }

        return Inertia::render('Teacher/Behavior/Create', [
            'classes' => $classes,
            'sections' => $sections,
            'students' => $students,
            'filters' => $request->only('class_id', 'section_id'),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'class_id' => 'required|exists:academic_classes,id',
            'section_id' => 'required|exists:sections,id',
            'student_id' => 'required|exists:students,id',
            'note' => 'nullable|string',
            'attachment' => 'nullable|file|max:20480', // 20MB max
        ]);

        $path = null;
        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('behaviors', 'public');
        }

        Behavior::create([
            'teacher_id' => auth()->id(),
            'title' => $request->title,
            'date' => $request->date,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'student_id' => $request->student_id,
            'note' => $request->note,
            'attachment' => $path,
        ]);

        return redirect()->route('teacher.behaviors.index')->with('success', 'Behavior recorded successfully.');
    }

    public function edit(Request $request, Behavior $behavior)
    {
        $classes = AcademicClass::all();
        
        // When editing, we need to load sections and students for the current behavior if not explicitly overridden by request
        $classId = $request->class_id ?: $behavior->class_id;
        $sectionId = $request->section_id ?: $behavior->section_id;

        $sections = Section::where('class_id', $classId)->get();
        
        $students = Student::where('class_id', $classId)
                           ->where('section_id', $sectionId)
                           ->get();

        return Inertia::render('Teacher/Behavior/Edit', [
            'behavior' => $behavior,
            'classes' => $classes,
            'sections' => $sections,
            'students' => $students,
            'filters' => [
                'class_id' => $classId,
                'section_id' => $sectionId,
            ],
        ]);
    }

    public function update(Request $request, Behavior $behavior)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'class_id' => 'required|exists:academic_classes,id',
            'section_id' => 'required|exists:sections,id',
            'student_id' => 'required|exists:students,id',
            'note' => 'nullable|string',
            'attachment' => 'nullable|file|max:20480',
        ]);

        $path = $behavior->attachment;
        if ($request->hasFile('attachment')) {
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
            $path = $request->file('attachment')->store('behaviors', 'public');
        }

        $behavior->update([
            'title' => $request->title,
            'date' => $request->date,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'student_id' => $request->student_id,
            'note' => $request->note,
            'attachment' => $path,
        ]);

        return redirect()->route('teacher.behaviors.index')->with('success', 'Behavior updated successfully.');
    }

    public function download(Behavior $behavior)
    {
        if ($behavior->attachment && Storage::disk('public')->exists($behavior->attachment)) {
            return Storage::disk('public')->download($behavior->attachment, basename($behavior->attachment));
        }

        return redirect()->back()->with('error', 'File not found.');
    }

    public function destroy(Behavior $behavior)
    {
        if ($behavior->attachment && Storage::disk('public')->exists($behavior->attachment)) {
            Storage::disk('public')->delete($behavior->attachment);
        }
        
        $behavior->delete();

        return redirect()->route('teacher.behaviors.index')->with('success', 'Behavior deleted successfully.');
    }
}
