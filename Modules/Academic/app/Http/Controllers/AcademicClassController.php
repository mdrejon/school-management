<?php

namespace Modules\Academic\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Modules\Academic\Models\AcademicClass;

class AcademicClassController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Academic/Classes/Index', [
            'classes' => AcademicClass::latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        AcademicClass::create($data);

        return back()->with('success', 'Class created successfully.');
    }

    public function update(Request $request, AcademicClass $class)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $class->update($data);

        return back()->with('success', 'Class updated successfully.');
    }

    public function destroy(AcademicClass $class)
    {
        $class->delete();
        return back()->with('success', 'Class deleted successfully.');
    }
}
