<?php

namespace Modules\Teacher\Http\Controllers;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $today = \Carbon\Carbon::today()->toDateString();
        
        $totalStudents = \Illuminate\Support\Facades\DB::table('students')->count();
        $todayAttendance = \Illuminate\Support\Facades\DB::table('student_attendances')->where('date', $today)->count();
        $present = \Illuminate\Support\Facades\DB::table('student_attendances')->where('date', $today)->where('status', 'present')->count();
        $absent = \Illuminate\Support\Facades\DB::table('student_attendances')->where('date', $today)->where('status', 'absent')->count();

        return Inertia::render('Teacher/Dashboard', [
            'totalStudents' => $totalStudents,
            'todayAttendance' => $todayAttendance,
            'present' => $present,
            'absent' => $absent,
            'classRoutine' => []
        ]);
    }
}
