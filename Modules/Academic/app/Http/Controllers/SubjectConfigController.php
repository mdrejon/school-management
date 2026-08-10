<?php

namespace Modules\Academic\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Modules\Academic\Models\SubjectConfig;
use Modules\Academic\Models\AcademicClass;
use Modules\Academic\Models\AcademicGroup;
use Modules\Academic\Models\Subject;

class SubjectConfigController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Admin/Academic/SubjectConfigs/Form', [
            'configs' => SubjectConfig::with(['subject', 'academicClass', 'academicGroup'])->get(),
            'classes' => AcademicClass::all(),
            'groups' => AcademicGroup::all(),
            'subjects' => Subject::all(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'academic_class_id' => 'required|exists:academic_classes,id',
            'academic_group_id' => 'nullable|exists:academic_groups,id',
            'subject_ids' => 'required|array',
            'subject_ids.*' => 'exists:subjects,id',
        ]);

        foreach ($data['subject_ids'] as $subjectId) {
            SubjectConfig::updateOrCreate([
                'academic_class_id' => $data['academic_class_id'],
                'academic_group_id' => $data['academic_group_id'],
                'subject_id' => $subjectId,
            ], [
                'subject_type' => 'COMPULSORY',
            ]);
        }

        return back()->with('success', 'Subject Configs saved successfully.');
    }

    public function update(Request $request, SubjectConfig $subjectConfig)
    {
        $data = $request->validate([
            'subject_type' => 'nullable|string',
            'serial_no' => 'nullable|string',
            'merge_id' => 'nullable|string',
        ]);

        $subjectConfig->update($data);

        return back()->with('success', 'Subject Config updated successfully.');
    }

    public function destroy(SubjectConfig $subjectConfig)
    {
        $subjectConfig->delete();
        return back()->with('success', 'Subject Config deleted successfully.');
    }
}
