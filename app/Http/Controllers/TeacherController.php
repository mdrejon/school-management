<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\TeacherPageSetting;
use Illuminate\View\View;

class TeacherController extends Controller
{
    public function index(): View
    {
        return view('frontend.teachers.index', [
            'teachers' => Teacher::where('is_active', true)->orderBy('sort_order')->paginate(12),
            'pageSettings' => TeacherPageSetting::current(),
        ]);
    }

    public function show(Teacher $teacher): View
    {
        abort_unless($teacher->is_active, 404);

        return view('frontend.teachers.show', [
            'teacher' => $teacher,
            'pageSettings' => TeacherPageSetting::current(),
        ]);
    }
}
