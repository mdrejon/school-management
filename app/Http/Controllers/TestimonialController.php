<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Models\TestimonialPageSetting;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function index(): View
    {
        return view('frontend.testimonials.index', [
            'testimonials' => Testimonial::where('is_active', true)->orderBy('sort_order')->get(),
            'pageSettings' => TestimonialPageSetting::current(),
        ]);
    }
}
