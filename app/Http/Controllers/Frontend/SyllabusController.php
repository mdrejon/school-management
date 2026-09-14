<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Academic\Models\Syllabus;
use Modules\Academic\Models\AcademicClass;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SyllabusController extends Controller
{
    public function index(Request $request)
    {
        $classes = AcademicClass::orderBy('name')->get();

        $query = Syllabus::with('academicClass');

        if ($request->filled('class_id')) {
            $query->where('class_id', $request->class_id);
        }

        $syllabi = $query->latest()->paginate(15)->withQueryString();

        return view('frontend.syllabus.index', compact('syllabi', 'classes'));
    }

    public function download($id)
    {
        $syllabus = Syllabus::findOrFail($id);

        if (!$syllabus->file_path || !Storage::disk('public')->exists($syllabus->file_path)) {
            return back()->with('error', 'File not found.');
        }

        return Storage::disk('public')->download($syllabus->file_path, $syllabus->title . '.' . pathinfo($syllabus->file_path, PATHINFO_EXTENSION));
    }
}
