<?php

namespace Modules\Academic\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Modules\Academic\Models\Shift;

class ShiftController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Academic/Shifts/Index', [
            'shifts' => Shift::latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Shift::create($data);

        return back()->with('success', 'Shift created successfully.');
    }

    public function update(Request $request, Shift $shift)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $shift->update($data);

        return back()->with('success', 'Shift updated successfully.');
    }

    public function destroy(Shift $shift)
    {
        $shift->delete();
        return back()->with('success', 'Shift deleted successfully.');
    }
}
