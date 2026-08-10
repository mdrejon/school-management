<?php

namespace Modules\Academic\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\Academic\Models\AcademicClass;
use Modules\Academic\Models\Section;
use Modules\Academic\Models\AcademicSubject;
use Modules\Academic\Models\ClassRoutine;
use App\Models\User;

class ClassRoutineController extends Controller
{
    public function index()
    {
        $classes = AcademicClass::all();
        // Since we need to show class/section pairs in the table, let's fetch combinations
        // If a class has sections, show rows for each section. If no section, show N/A.
        
        $routinesList = [];
        foreach ($classes as $class) {
            $sections = Section::where('academic_class_id', $class->id)->get();
            if ($sections->isEmpty()) {
                $routinesList[] = [
                    'class_id' => $class->id,
                    'class_name' => $class->name,
                    'section_id' => null,
                    'section_name' => 'N/A',
                ];
            } else {
                foreach ($sections as $sec) {
                    $routinesList[] = [
                        'class_id' => $class->id,
                        'class_name' => $class->name,
                        'section_id' => $sec->id,
                        'section_name' => $sec->name,
                    ];
                }
            }
        }

        return Inertia::render('Admin/Academic/ClassRoutine/Index', [
            'classes' => $classes,
            'routinesList' => $routinesList,
        ]);
    }

    public function manage($classId, $sectionId = null)
    {
        if ($sectionId == 'null') $sectionId = null;

        $class = AcademicClass::findOrFail($classId);
        $section = $sectionId ? Section::findOrFail($sectionId) : null;
        $subjects = AcademicSubject::all();
        // Assume teachers are Users with a specific role or just all users for now
        $teachers = User::all(); 

        $routines = ClassRoutine::where('class_id', $classId)
            ->where('section_id', $sectionId)
            ->get()
            ->groupBy('day_of_week');

        $days = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

        $routineData = [];
        foreach ($days as $day) {
            $routineData[$day] = isset($routines[$day]) ? $routines[$day] : [];
        }

        return Inertia::render('Admin/Academic/ClassRoutine/Manage', [
            'academicClass' => $class,
            'section' => $section,
            'subjects' => $subjects,
            'teachers' => $teachers,
            'routineData' => $routineData,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'section_id' => 'nullable',
            'day_of_week' => 'required',
            'routines' => 'array',
        ]);

        $classId = $request->class_id;
        $sectionId = $request->section_id;
        $day = $request->day_of_week;

        // Delete existing routines for this day/class/section
        ClassRoutine::where('class_id', $classId)
            ->where('section_id', $sectionId)
            ->where('day_of_week', $day)
            ->delete();

        if (isset($request->routines) && is_array($request->routines)) {
            foreach ($request->routines as $routine) {
                if (!empty($routine['subject_id'])) {
                    ClassRoutine::create([
                        'class_id' => $classId,
                        'section_id' => $sectionId,
                        'subject_id' => $routine['subject_id'],
                        'teacher_id' => $routine['teacher_id'] ?? null,
                        'day_of_week' => $day,
                        'start_time' => $routine['start_time'] ?? null,
                        'end_time' => $routine['end_time'] ?? null,
                        'room' => $routine['room'] ?? null,
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', $day . ' routine saved successfully.');
    }
}
