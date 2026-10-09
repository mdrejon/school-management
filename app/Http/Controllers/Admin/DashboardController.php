<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(): Response
    {
        $studentsCount = DB::table('students')->count();
        $teachersCount = DB::table('teachers')->count();
        $staffCount = DB::table('staffs')->count();
        
        $pendingAdmissionsCount = DB::table('students')->where('status', 'pending')->count();
        
        $recentAdmissions = \Modules\Student\Models\Student::with('academicClass')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($student) {
                return [
                    'name' => $student->first_name . ' ' . $student->last_name,
                    'class' => $student->academicClass ? $student->academicClass->name : 'N/A',
                    'status' => $student->status ?? 'approved',
                ];
            });

        // Group by month for chart data (last 7 months)
        $months = [];
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $months[] = $month->format('M');
            $data[] = DB::table('students')
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }

        $chartData = [
            'labels' => $months,
            'datasets' => [
                [
                    'label' => 'New Admissions',
                    'data' => $data,
                    'fill' => true,
                    'borderColor' => '#6366f1',
                    'backgroundColor' => 'rgba(99, 102, 241, 0.15)',
                    'tension' => 0.4,
                ]
            ]
        ];

        return Inertia::render('Admin/Dashboard', [
            'studentsCount' => number_format($studentsCount),
            'teachersCount' => number_format($teachersCount),
            'staffCount' => number_format($staffCount),
            'pendingCount' => number_format($pendingAdmissionsCount),
            'recentAdmissions' => $recentAdmissions,
            'chartData' => $chartData,
        ]);
    }
}
