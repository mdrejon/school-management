<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\FaqPageSetting;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(): View
    {
        return view('frontend.faq.index', [
            'faqs' => Faq::where('is_active', true)->orderBy('sort_order')->get(),
            'pageSettings' => FaqPageSetting::current(),
        ]);
    }
}
