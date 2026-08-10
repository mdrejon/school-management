<?php

namespace Modules\Teacher\Http\Controllers;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Teacher/Dashboard', [
            'totalStudents' => 103, // Mock data based on the screenshot
            'todayAttendance' => 0,
            'present' => 0,
            'absent' => 0,
            'classRoutine' => []
        ]);
    }
}
