<?php

namespace Modules\Exam\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\Exam\Models\ExamRemark;

class ExamRemarkController extends Controller
{
    public function index()
    {
        $remarks = ExamRemark::orderBy('id', 'desc')->get();
        return Inertia::render('Admin/Exam/RemarkConfig/Index', [
            'remarks' => $remarks
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'remarks' => 'required|string',
        ]);

        ExamRemark::create($request->all());

        return redirect()->back()->with('success', 'Remark created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'remarks' => 'required|string',
        ]);

        $remark = ExamRemark::findOrFail($id);
        $remark->update($request->all());

        return redirect()->back()->with('success', 'Remark updated successfully.');
    }

    public function destroy($id)
    {
        $remark = ExamRemark::findOrFail($id);
        $remark->delete();

        return redirect()->back()->with('success', 'Remark deleted successfully.');
    }
}
