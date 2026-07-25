<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\FacilityPageSetting;
use Illuminate\View\View;

class FacilityController extends Controller
{
    public function index(): View
    {
        return view('frontend.facilities.index', [
            'facilities' => Facility::where('is_active', true)->orderBy('sort_order')->paginate(12),
            'pageSettings' => FacilityPageSetting::current(),
        ]);
    }

    public function show(Facility $facility): View
    {
        abort_unless($facility->is_active, 404);

        return view('frontend.facilities.show', [
            'facility' => $facility,
            'pageSettings' => FacilityPageSetting::current(),
        ]);
    }
}
