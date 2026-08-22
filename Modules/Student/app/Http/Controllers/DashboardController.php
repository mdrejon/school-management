<?php

namespace Modules\Student\Http\Controllers;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        // We will mock dynamic data for now as we don't have the full relational mapping
        // but we'll use DB queries to pull something realistic.
        
        $today = \Carbon\Carbon::today()->toDateString();
        
        // Count total assignments (or due assignments if there's a due_date)
        $assignmentsDue = \Illuminate\Support\Facades\DB::table('assignments')->count();
        
        // Classes today
        $todayClasses = \Illuminate\Support\Facades\DB::table('class_routines')->where('day', strtolower(date('l')))->count();

        return Inertia::render('Student/Dashboard', [
            'todayClasses' => $todayClasses,
            'assignmentsDue' => $assignmentsDue,
        ]);
    }
}
