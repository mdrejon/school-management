<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\VideoGallery;
use App\Models\VideoGalleryPageSetting;
use Illuminate\View\View;

class VideoGalleryController extends Controller
{
    public function index(): View
    {
        return view('frontend.video-gallery', [
            'videos' => VideoGallery::where('is_active', true)->orderBy('sort_order')->paginate(12),
            'pageSettings' => VideoGalleryPageSetting::current(),
        ]);
    }
}
