<?php

namespace Modules\Academic\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Modules\Academic\Models\OptionalSubjectConfig;
use Modules\Academic\Models\AcademicClass;
use Modules\Academic\Models\AcademicGroup;
use Modules\Academic\Models\Subject;

class OptionalSubjectConfigController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Academic/OptionalSubjectConfigs/Index', [
            'configs' => OptionalSubjectConfig::with(['academicClass', 'academicGroup', 'subjects'])->latest()->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Academic/OptionalSubjectConfigs/Form', [
            'config' => null,
            'classes' => AcademicClass::all(),
            'groups' => AcademicGroup::all(),
            'subjects' => Subject::all(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'academic_class_id' => 'nullable|exists:academic_classes,id',
            'academic_group_id' => 'nullable|exists:academic_groups,id',
            'limit' => 'required|integer|min:1',
            'subject_ids' => 'required|array',
            'subject_ids.*' => 'exists:subjects,id',
        ]);

        $config = OptionalSubjectConfig::create([
            'name' => $data['name'],
            'academic_class_id' => $data['academic_class_id'],
            'academic_group_id' => $data['academic_group_id'],
            'limit' => $data['limit'],
        ]);

        $config->subjects()->sync($data['subject_ids']);

        return redirect()->route('admin.academic.optional-subject-configs.index')->with('success', 'Optional Subject Config created successfully.');
    }

    public function edit(OptionalSubjectConfig $optionalSubjectConfig): Response
    {
        $optionalSubjectConfig->load('subjects');
        
        return Inertia::render('Admin/Academic/OptionalSubjectConfigs/Form', [
            'config' => $optionalSubjectConfig,
            'classes' => AcademicClass::all(),
            'groups' => AcademicGroup::all(),
            'subjects' => Subject::all(),
        ]);
    }

    public function update(Request $request, OptionalSubjectConfig $optionalSubjectConfig)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'academic_class_id' => 'nullable|exists:academic_classes,id',
            'academic_group_id' => 'nullable|exists:academic_groups,id',
            'limit' => 'required|integer|min:1',
            'subject_ids' => 'required|array',
            'subject_ids.*' => 'exists:subjects,id',
        ]);

        $optionalSubjectConfig->update([
            'name' => $data['name'],
            'academic_class_id' => $data['academic_class_id'],
            'academic_group_id' => $data['academic_group_id'],
            'limit' => $data['limit'],
        ]);

        $optionalSubjectConfig->subjects()->sync($data['subject_ids']);

        return redirect()->route('admin.academic.optional-subject-configs.index')->with('success', 'Optional Subject Config updated successfully.');
    }

    public function destroy(OptionalSubjectConfig $optionalSubjectConfig)
    {
        $optionalSubjectConfig->delete();
        return back()->with('success', 'Optional Subject Config deleted successfully.');
    }
}
