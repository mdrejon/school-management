<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;

class TuitionFeeController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::current();
        return view('frontend.tuition-fees', compact('settings'));
    }
}
