<?php

namespace App\Http\Controllers;

use App\Models\CampusTourPageSetting;
use App\Models\GalleryImage;
use Illuminate\View\View;

class CampusTourController extends Controller
{
    public function index(): View
    {
        return view('frontend.campus-tour', [
            'pageSettings' => CampusTourPageSetting::current(),
            'images' => GalleryImage::where('is_active', true)->orderBy('sort_order')->paginate(18),
        ]);
    }
}
