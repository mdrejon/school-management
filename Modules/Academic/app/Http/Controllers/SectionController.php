<?php

namespace Modules\Academic\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Modules\Academic\Models\Section;
use Modules\Academic\Models\AcademicClass;
use Modules\Academic\Models\AcademicGroup;

class SectionController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Academic/Sections/Index', [
            'sections' => Section::with(['academicClass', 'academicGroup'])->latest()->get(),
            'classes' => AcademicClass::all(),
            'groups' => AcademicGroup::all(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'academic_class_id' => 'required|exists:academic_classes,id',
            'academic_group_id' => 'nullable|exists:academic_groups,id',
            'name' => 'required|string|max:255',
            'room_no' => 'nullable|string|max:255',
        ]);

        Section::create($data);

        return back()->with('success', 'Section created successfully.');
    }

    public function update(Request $request, Section $section)
    {
        $data = $request->validate([
            'academic_class_id' => 'required|exists:academic_classes,id',
            'academic_group_id' => 'nullable|exists:academic_groups,id',
            'name' => 'required|string|max:255',
            'room_no' => 'nullable|string|max:255',
        ]);

        $section->update($data);

        return back()->with('success', 'Section updated successfully.');
    }

    public function destroy(Section $section)
    {
        $section->delete();
        return back()->with('success', 'Section deleted successfully.');
    }
}
