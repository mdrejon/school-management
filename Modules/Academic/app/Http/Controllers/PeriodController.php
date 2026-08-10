<?php

namespace Modules\Academic\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Modules\Academic\Models\Period;

class PeriodController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Academic/Periods/Index', [
            'periods' => Period::latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'serial_no' => 'nullable|string|max:255',
        ]);

        Period::create($data);

        return back()->with('success', 'Period created successfully.');
    }

    public function update(Request $request, Period $period)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'serial_no' => 'nullable|string|max:255',
        ]);

        $period->update($data);

        return back()->with('success', 'Period updated successfully.');
    }

    public function destroy(Period $period)
    {
        $period->delete();
        return back()->with('success', 'Period deleted successfully.');
    }
}
