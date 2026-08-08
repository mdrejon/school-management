<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Models\VisionMissionPageSetting;
use Illuminate\View\View;

class VisionMissionController extends Controller
{
    public function index(): View
    {
        return view('frontend.mission-vision', [
            'pageSettings' => VisionMissionPageSetting::current(),
            'siteSettings' => SiteSetting::current(),
        ]);
    }
}
