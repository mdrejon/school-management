<?php

namespace Modules\Academic\Http\Controllers\Admin;

use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\Academic\Models\AcademicClass;
use Modules\Academic\Models\Section;
use Modules\Academic\Models\Subject;
use Modules\Academic\Models\Resource;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{
    public function index(Request $request)
    {
        $query = Resource::with(['academicClass', 'section', 'subject', 'session'])->latest();
        
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        $perPage = $request->per_page ?: 10;
        $resources = $query->paginate($perPage)->withQueryString();

        return Inertia::render('Admin/Academic/Resource/Index', [
            'resources' => $resources,
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

        return Inertia::render('Admin/Academic/Resource/Create', [
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
                    $path = $file->store('resources', 'public');
                    $filePaths[] = $path;
                }
            }
        }

        Resource::create([
            'teacher_id' => $request->teacher_id ?? auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'subject_id' => $request->subject_id,
            'files' => $filePaths,
        ]);

        return redirect()->route('admin.academic.resources.index')->with('success', 'Resource created successfully.');
    }

    public function destroy(Resource $resource)
    {
        if ($resource->files) {
            foreach ($resource->files as $file) {
                Storage::disk('public')->delete($file);
            }
        }
        
        $resource->delete();

        return redirect()->route('admin.academic.resources.index')->with('success', 'Resource deleted successfully.');
    }
}
