<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use App\Models\GalleryPageSetting;
use Illuminate\View\View;

class GalleryImageController extends Controller
{
    public function index(): View
    {
        return view('frontend.gallery.index', [
            'images' => GalleryImage::where('is_active', true)->orderBy('sort_order')->paginate(18),
            'pageSettings' => GalleryPageSetting::current(),
        ]);
    }
}
