<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Student\Models\Student;
use Modules\Academic\Models\AcademicClass;
use Modules\Academic\Models\Section;
use App\Models\SiteSetting;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $settings = SiteSetting::current();

        $query = Student::query()
            ->with(['academicClass', 'section'])
            ->where('status', 'approved'); // Assuming we only show approved students

        if ($request->filled('class_id')) {
            $query->where('class_id', $request->class_id);
        }

        if ($request->filled('section_id')) {
            $query->where('section_id', $request->section_id);
        }

        if ($request->filled('group')) {
            $query->where('group', $request->group);
        }

        if ($request->filled('roll_no')) {
            $query->where('roll_no', 'like', '%' . $request->roll_no . '%');
        }

        // Fetch options for the filter dropdowns
        $classes = AcademicClass::orderBy('name')->get();
        $sections = Section::orderBy('name')->get();
        // Since 'group' is a string field on students, we can either hardcode the common groups or get distinct groups
        $groups = Student::select('group')->whereNotNull('group')->distinct()->pluck('group');

        // If no search parameters are present, don't show any students
        if (!$request->anyFilled(['class_id', 'section_id', 'group', 'roll_no'])) {
            $query->whereRaw('1 = 0');
        }

        $students = $query->paginate(20)->withQueryString();

        return view('frontend.students.index', compact(
            'students',
            'classes',
            'sections',
            'groups',
            'settings'
        ));
    }
}
