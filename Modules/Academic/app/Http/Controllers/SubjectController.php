<?php

namespace Modules\Academic\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Modules\Academic\Models\Subject;
use Modules\Academic\Models\AcademicClass;
use Modules\Academic\Models\AcademicGroup;

class SubjectController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Academic/Subjects/Index', [
            'subjects' => Subject::with(['academicClass', 'academicGroup'])->latest()->get(),
            'classes' => AcademicClass::all(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Academic/Subjects/Form', [
            'subject' => null,
            'classes' => AcademicClass::all(),
            'groups' => AcademicGroup::all(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'academic_class_id' => 'nullable|exists:academic_classes,id',
            'academic_group_id' => 'nullable|exists:academic_groups,id',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'short_form' => 'nullable|string|max:255',
            'type' => 'required|string|max:255',
            'serial_no' => 'nullable|string|max:255',
        ]);

        Subject::create($data);

        return redirect()->route('admin.academic.subjects.index')->with('success', 'Subject created successfully.');
    }

    public function edit(Subject $subject): Response
    {
        return Inertia::render('Admin/Academic/Subjects/Form', [
            'subject' => $subject,
            'classes' => AcademicClass::all(),
            'groups' => AcademicGroup::all(),
        ]);
    }

    public function update(Request $request, Subject $subject)
    {
        $data = $request->validate([
            'academic_class_id' => 'nullable|exists:academic_classes,id',
            'academic_group_id' => 'nullable|exists:academic_groups,id',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'short_form' => 'nullable|string|max:255',
            'type' => 'required|string|max:255',
            'serial_no' => 'nullable|string|max:255',
        ]);

        $subject->update($data);

        return redirect()->route('admin.academic.subjects.index')->with('success', 'Subject updated successfully.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return back()->with('success', 'Subject deleted successfully.');
    }
}
