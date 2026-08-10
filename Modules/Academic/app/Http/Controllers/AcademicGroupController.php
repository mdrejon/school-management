<?php

namespace Modules\Academic\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Modules\Academic\Models\AcademicGroup;

class AcademicGroupController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Academic/Groups/Index', [
            'groups' => AcademicGroup::latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        AcademicGroup::create($data);

        return back()->with('success', 'Group created successfully.');
    }

    public function update(Request $request, AcademicGroup $group)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $group->update($data);

        return back()->with('success', 'Group updated successfully.');
    }

    public function destroy(AcademicGroup $group)
    {
        $group->delete();
        return back()->with('success', 'Group deleted successfully.');
    }
}
