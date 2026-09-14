<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Academic\Models\ClassRoutine;
use Modules\Academic\Models\AcademicClass;

class ClassRoutineController extends Controller
{
    public function index(Request $request)
    {
        $classes = AcademicClass::with('sections')->orderBy('name')->get();

        $routines = collect();
        $days = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

        if ($request->filled('class')) {
            $parts = explode('-', $request->class);
            $classId = $parts[0] ?? null;
            $sectionId = (isset($parts[1]) && $parts[1] !== 'null') ? $parts[1] : null;

            $routines = ClassRoutine::with(['subject', 'teacher', 'section'])
                ->where('class_id', $classId)
                ->where('section_id', $sectionId)
                ->orderBy('start_time')
                ->get()
                ->groupBy('day_of_week');
        }

        return view('frontend.class-routine.index', compact('routines', 'classes', 'days'));
    }
}
