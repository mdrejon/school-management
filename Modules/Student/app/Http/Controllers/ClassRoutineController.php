<?php

namespace Modules\Student\Http\Controllers;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Modules\Academic\Models\ClassRoutine;
use Modules\Student\Models\Student;

class ClassRoutineController extends Controller
{
    /**
     * Display a listing of the class routine for the student.
     */
    public function index()
    {
        $student = Student::with(['academicClass', 'section'])
            ->where('user_id', auth()->id())
            ->first();

        if (!$student) {
            abort(403, 'Student record not found.');
        }

        $routines = ClassRoutine::with(['subject', 'teacher'])
            ->where('class_id', $student->class_id)
            ->where('section_id', $student->section_id)
            ->orderBy('start_time')
            ->get();

        $groupedRoutines = [
            'Saturday' => [],
            'Sunday' => [],
            'Monday' => [],
            'Tuesday' => [],
            'Wednesday' => [],
            'Thursday' => [],
            'Friday' => [],
        ];

        foreach ($routines as $routine) {
            $day = ucfirst($routine->day_of_week);
            if (isset($groupedRoutines[$day])) {
                $groupedRoutines[$day][] = $routine;
            }
        }

        return Inertia::render('Student/ClassRoutine/Index', [
            'routines' => $groupedRoutines,
            'studentClass' => $student->academicClass ? $student->academicClass->name : 'N/A',
            'studentSection' => $student->section ? $student->section->name : 'N/A',
        ]);
    }
}
