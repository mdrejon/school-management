<?php

namespace Modules\Staff\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class StaffAttendanceController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Staff/Attendance/Index', [
            // Dummy data or actual data for attendance logic can be passed here
        ]);
    }
}
