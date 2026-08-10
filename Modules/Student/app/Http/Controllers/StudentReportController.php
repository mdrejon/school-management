<?php

namespace Modules\Student\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Student\Models\Student;
use Inertia\Inertia;

class StudentReportController extends Controller
{
    public function atAGlance(Request $request)
    {
        $students = Student::with('user')->latest()->get();

        return Inertia::render('Admin/Student/AtAGlance', [
            'students' => $students,
        ]);
    }
}
