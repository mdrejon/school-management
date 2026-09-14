<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Campus;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EducationLevelController extends Controller
{
    public function index(): View
    {
        // Load the page settings for SEO/Breadcrumb data
        $page = \App\Models\EducationLevelPageSetting::current();

        // Fetch Campuses with active Levels and active Classes
        $campuses = Campus::with(['levels' => function ($query) {
            $query->where('is_active', true)
                  ->orderBy('sort_order')
                  ->with(['classes' => function ($q) {
                      $q->where('is_active', true)->orderBy('sort_order');
                  }]);
        }])
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get();

        return view('frontend.education-levels', compact('page', 'campuses'));
    }
}
