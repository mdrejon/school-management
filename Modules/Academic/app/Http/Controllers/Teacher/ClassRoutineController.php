<?php

namespace Modules\Academic\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\Academic\Models\ClassRoutine;

class ClassRoutineController extends Controller
{
    public function myRoutine(Request $request)
    {
        $teacherId = auth()->id();
        
        // Fetch routines for this teacher, group by day
        $routines = ClassRoutine::with(['academicClass', 'section', 'subject'])
            ->where('teacher_id', $teacherId)
            ->get()
            ->groupBy('day_of_week');

        return Inertia::render('Teacher/Academic/ClassRoutine/MyRoutine', [
            'routineData' => $routines
        ]);
    }
}
