<?php

namespace Modules\Student\Http\Controllers;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Modules\Academic\Models\Syllabus;
use Modules\Student\Models\Student;

class SyllabusController extends Controller
{
    /**
     * Display a listing of the syllabuses for the student.
     */
    public function index()
    {
        $student = Student::where('user_id', auth()->id())->first();

        if (!$student) {
            abort(403, 'Student record not found.');
        }

        // Syllabuses are assigned to a class
        $syllabuses = Syllabus::with('academicClass')
            ->where('class_id', $student->class_id)
            ->latest()
            ->paginate(50);

        return Inertia::render('Student/Syllabus/Index', [
            'syllabuses' => $syllabuses
        ]);
    }
}
