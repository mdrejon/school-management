<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;

class ResultController extends Controller
{
    public function exam()
    {
        $settings = SiteSetting::current();
        return view('frontend.exam-result', compact('settings'));
    }

    public function academic()
    {
        $settings = SiteSetting::current();
        return view('frontend.academic-result', compact('settings'));
    }

    public function evaluation()
    {
        $settings = SiteSetting::current();
        return view('frontend.evaluation-result', compact('settings'));
    }

    public function boardExam()
    {
        $settings = SiteSetting::current();
        return view('frontend.board-exam-result', compact('settings'));
    }
}
