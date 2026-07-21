<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CoursePageSetting;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function index(): View
    {
        return view('frontend.courses.index', [
            'courses' => Course::where('is_active', true)->orderBy('sort_order')->paginate(12),
            'pageSettings' => CoursePageSetting::current(),
        ]);
    }

    public function show(Course $course): View
    {
        abort_unless($course->is_active, 404);

        return view('frontend.courses.show', [
            'course' => $course,
            'pageSettings' => CoursePageSetting::current(),
        ]);
    }
}
