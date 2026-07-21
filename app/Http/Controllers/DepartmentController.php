<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\DepartmentPageSetting;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    public function index(): View
    {
        return view('frontend.departments.index', [
            'departments' => Department::where('is_active', true)->orderBy('sort_order')->paginate(12),
            'pageSettings' => DepartmentPageSetting::current(),
        ]);
    }

    public function show(Department $department): View
    {
        abort_unless($department->is_active, 404);

        return view('frontend.departments.show', [
            'department' => $department,
            'otherDepartments' => Department::where('is_active', true)
                ->where('id', '!=', $department->id)
                ->orderBy('sort_order')
                ->get(),
            'pageSettings' => DepartmentPageSetting::current(),
        ]);
    }
}
