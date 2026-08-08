<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use App\Models\Founder;
use App\Models\FounderDonorPageSetting;
use Illuminate\View\View;

class FounderDonorController extends Controller
{
    public function index(): View
    {
        return view('frontend.founders-donors.index', [
            'founders' => Founder::where('is_active', true)->orderBy('sort_order')->get(),
            'donors' => Donor::where('is_active', true)->orderBy('sort_order')->get(),
            'pageSettings' => FounderDonorPageSetting::current(),
        ]);
    }
}
