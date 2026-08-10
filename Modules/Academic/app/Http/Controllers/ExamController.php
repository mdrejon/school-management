<?php

namespace Modules\Academic\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Modules\Academic\Models\Exam;

class ExamController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Academic/Exams/Index', [
            'exams' => Exam::latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:255',
        ]);

        Exam::create($data);

        return back()->with('success', 'Exam created successfully.');
    }

    public function update(Request $request, Exam $exam)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:255',
        ]);

        $exam->update($data);

        return back()->with('success', 'Exam updated successfully.');
    }

    public function destroy(Exam $exam)
    {
        $exam->delete();
        return back()->with('success', 'Exam deleted successfully.');
    }
}
