<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\PortfolioPageSetting;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(): View
    {
        return view('frontend.portfolios.index', [
            'portfolios' => Portfolio::where('is_active', true)->orderBy('sort_order')->paginate(12),
            'pageSettings' => PortfolioPageSetting::current(),
        ]);
    }

    public function show(Portfolio $portfolio): View
    {
        abort_unless($portfolio->is_active, 404);

        return view('frontend.portfolios.show', [
            'portfolio' => $portfolio,
            'pageSettings' => PortfolioPageSetting::current(),
        ]);
    }
}
