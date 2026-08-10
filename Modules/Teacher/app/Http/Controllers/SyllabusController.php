<?php

namespace Modules\Teacher\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\Academic\Models\AcademicClass;
use Modules\Academic\Models\Syllabus;
use Illuminate\Support\Facades\Storage;

class SyllabusController extends Controller
{
    public function index(Request $request)
    {
        $query = Syllabus::with('academicClass')->latest();
        
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        $perPage = $request->per_page ?: 50;
        $syllabuses = $query->paginate($perPage)->withQueryString();

        return Inertia::render('Teacher/Syllabus/Index', [
            'syllabuses' => $syllabuses,
            'filters' => $request->only('search', 'per_page'),
        ]);
    }

    public function create()
    {
        $classes = AcademicClass::all();

        return Inertia::render('Teacher/Syllabus/Create', [
            'classes' => $classes,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'class_id' => 'required|exists:academic_classes,id',
            'file' => 'required|file|max:20480', // 20MB max
        ]);

        $path = $request->file('file')->store('syllabi', 'public');

        Syllabus::create([
            'teacher_id' => auth()->id(),
            'class_id' => $request->class_id,
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $path,
        ]);

        return redirect()->route('teacher.syllabuses.index')->with('success', 'Syllabus created successfully.');
    }

    public function download(Syllabus $syllabus)
    {
        if (Storage::disk('public')->exists($syllabus->file_path)) {
            return Storage::disk('public')->download($syllabus->file_path, basename($syllabus->file_path));
        }

        return redirect()->back()->with('error', 'File not found.');
    }

    public function destroy(Syllabus $syllabus)
    {
        if (Storage::disk('public')->exists($syllabus->file_path)) {
            Storage::disk('public')->delete($syllabus->file_path);
        }
        
        $syllabus->delete();

        return redirect()->route('teacher.syllabuses.index')->with('success', 'Syllabus deleted successfully.');
    }
}
