<?php

namespace Modules\Student\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\Exam\Models\ClassExam;
use Modules\Student\Models\Student;

class ExamRoutineController extends Controller
{
    /**
     * Display a listing of the exams to view routine.
     */
    public function index()
    {
        $student = Student::where('user_id', auth()->id())->first();

        if (!$student) {
            abort(403, 'Student record not found.');
        }

        $classExams = ClassExam::with('globalExam')
            ->where('class_id', $student->class_id)
            ->get()
            ->map(function ($exam) {
                return [
                    'id' => $exam->id,
                    'name' => $exam->globalExam ? $exam->globalExam->name : 'Unnamed Exam',
                ];
            });

        return Inertia::render('Student/ExamRoutine/Index', [
            'exams' => $classExams
        ]);
    }
}
