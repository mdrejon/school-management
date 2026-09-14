<?php

namespace App\Http\Controllers;

use Modules\Staff\Models\Staff;
use App\Models\Page;
use Illuminate\View\View;

class StaffController extends Controller
{
    public function index(): View
    {
        // Try to fetch page settings if they created a CMS page with slug 'staff-information'
        $page = Page::where('slug', 'staff-information')->first();

        return view('frontend.staff.index', [
            'staffs' => Staff::where('is_active', true)->paginate(12),
            'pageSettings' => $page,
        ]);
    }

    public function show(Staff $staff): View
    {
        abort_unless($staff->is_active, 404);

        $page = Page::where('slug', 'staff-information')->first();

        return view('frontend.staff.show', [
            'staff' => $staff,
            'pageSettings' => $page,
        ]);
    }
}
