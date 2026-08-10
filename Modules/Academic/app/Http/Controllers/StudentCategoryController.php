<?php

namespace Modules\Academic\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Modules\Academic\Models\StudentCategory;

class StudentCategoryController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Academic/StudentCategories/Index', [
            'categories' => StudentCategory::latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        StudentCategory::create($data);

        return back()->with('success', 'Student Category created successfully.');
    }

    public function update(Request $request, StudentCategory $studentCategory)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $studentCategory->update($data);

        return back()->with('success', 'Student Category updated successfully.');
    }

    public function destroy(StudentCategory $studentCategory)
    {
        $studentCategory->delete();
        return back()->with('success', 'Student Category deleted successfully.');
    }
}
