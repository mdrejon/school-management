<?php

namespace App\Http\Controllers;

use App\Models\ClassSchedule;
use App\Models\ClassSchedulePageSetting;
use Illuminate\View\View;

class ClassScheduleController extends Controller
{
    public function index(): View
    {
        return view('frontend.class-schedule', [
            'schedules' => ClassSchedule::where('is_active', true)->orderBy('sort_order')->get(),
            'pageSettings' => ClassSchedulePageSetting::current(),
        ]);
    }
}
