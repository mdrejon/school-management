<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campus;
use App\Models\EducationLevel;
use App\Models\EducationClass;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EducationLevelController extends Controller
{
    public function index()
    {
        $campuses = Campus::with(['levels.classes' => function ($query) {
            $query->orderBy('sort_order');
        }, 'levels' => function ($query) {
            $query->orderBy('sort_order');
        }])->orderBy('sort_order')->get();
        
        $pageSettings = \App\Models\EducationLevelPageSetting::current();

        return Inertia::render('Admin/Cms/EducationLevels', [
            'campuses' => $campuses,
            'pageSettings' => $pageSettings,
            'defaultLang' => config('app.fallback_locale'),
        ]);
    }

    // --- Campuses ---

    public function storeCampus(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|array',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        Campus::create($validated);

        return redirect()->back()->with('success', 'Campus created successfully.');
    }

    public function updateCampus(Request $request, Campus $campus)
    {
        $validated = $request->validate([
            'name' => 'required|array',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $campus->update($validated);

        return redirect()->back()->with('success', 'Campus updated successfully.');
    }

    public function destroyCampus(Campus $campus)
    {
        $campus->delete();
        return redirect()->back()->with('success', 'Campus deleted successfully.');
    }

    // --- Levels ---

    public function storeLevel(Request $request)
    {
        $validated = $request->validate([
            'campus_id' => 'required|exists:campuses,id',
            'name' => 'required|array',
            'description' => 'nullable|array',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        EducationLevel::create($validated);

        return redirect()->back()->with('success', 'Level created successfully.');
    }

    public function updateLevel(Request $request, EducationLevel $level)
    {
        $validated = $request->validate([
            'name' => 'required|array',
            'description' => 'nullable|array',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $level->update($validated);

        return redirect()->back()->with('success', 'Level updated successfully.');
    }

    public function destroyLevel(EducationLevel $level)
    {
        $level->delete();
        return redirect()->back()->with('success', 'Level deleted successfully.');
    }

    // --- Classes ---

    public function storeClass(Request $request)
    {
        $validated = $request->validate([
            'education_level_id' => 'required|exists:education_levels,id',
            'name' => 'required|array',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        EducationClass::create($validated);

        return redirect()->back()->with('success', 'Class created successfully.');
    }

    public function updateClass(Request $request, EducationClass $class)
    {
        $validated = $request->validate([
            'name' => 'required|array',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $class->update($validated);

        return redirect()->back()->with('success', 'Class updated successfully.');
    }

    public function destroyClass(EducationClass $class)
    {
        $class->delete();
        return redirect()->back()->with('success', 'Class deleted successfully.');
    }
}
