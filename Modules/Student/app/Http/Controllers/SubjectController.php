<?php

namespace Modules\Student\Http\Controllers;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Modules\Academic\Models\Subject;
use Modules\Student\Models\Student;

class SubjectController extends Controller
{
    /**
     * Display a listing of the subjects for the student.
     */
    public function index()
    {
        $student = Student::where('user_id', auth()->id())->first();

        if (!$student) {
            abort(403, 'Student record not found.');
        }

        // Subjects are assigned to a class, and optionally to a group
        $query = Subject::with('academicClass', 'academicGroup')
            ->where('academic_class_id', $student->class_id);
            
        // If student has a group assigned, we filter by that group or subjects that don't have a specific group
        // But some implementations just require filtering by class_id if group isn't strictly enforced.
        // The user mentioned "based on student class and section group based", so let's try to match group if it's set as an ID
        if (is_numeric($student->group)) {
            $query->where(function ($q) use ($student) {
                $q->where('academic_group_id', $student->group)
                  ->orWhereNull('academic_group_id');
            });
        }

        $subjects = $query->latest()->paginate(50);

        return Inertia::render('Student/Subject/Index', [
            'subjects' => $subjects
        ]);
    }
}
