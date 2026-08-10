<?php

namespace Modules\Exam\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\Exam\Models\ExamMark;

class ExamMarkController extends Controller
{
    public function index()
    {
        $marks = ExamMark::orderBy('id', 'desc')->get();
        return Inertia::render('Admin/Exam/MarkConfig/Index', [
            'marks' => $marks
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        ExamMark::create($request->all());

        return redirect()->back()->with('success', 'Mark configuration created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $mark = ExamMark::findOrFail($id);
        $mark->update($request->all());

        return redirect()->back()->with('success', 'Mark configuration updated successfully.');
    }

    public function destroy($id)
    {
        $mark = ExamMark::findOrFail($id);
        $mark->delete();

        return redirect()->back()->with('success', 'Mark configuration deleted successfully.');
    }
}
