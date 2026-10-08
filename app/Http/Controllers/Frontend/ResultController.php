<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use Modules\Exam\Models\GlobalExam;
use Modules\Exam\Models\ExamResult;
use Modules\Academic\Models\AcademicClass;
use Modules\Academic\Models\Section;

class ResultController extends Controller
{
    public function exam(Request $request)
    {
        $settings = SiteSetting::current();
        $exams = GlobalExam::where('is_active', true)->orderByDesc('id')->get();
        $classes = AcademicClass::all();
        $sections = Section::all();

        $searchResult = null;
        $hasSearched = false;

        if ($request->filled('roll_no')) {
            $hasSearched = true;
            $query = ExamResult::where('is_published', true)
                ->where('roll_no', trim($request->string('roll_no')));

            if ($request->filled('exam_id')) {
                $examVal = $request->input('exam_id');
                $query->where(function ($q) use ($examVal) {
                    $q->where('exam_id', $examVal)->orWhere('exam_name', $examVal);
                });
            }

            if ($request->filled('class_id')) {
                $classVal = $request->input('class_id');
                $query->where(function ($q) use ($classVal) {
                    $q->where('class_id', $classVal)->orWhere('class_name', $classVal);
                });
            }

            if ($request->filled('section')) {
                $query->where('section_name', $request->input('section'));
            }

            $searchResult = $query->first();
        }

        return view('frontend.exam-result', compact('settings', 'exams', 'classes', 'sections', 'searchResult', 'hasSearched'));
    }

    public function academic()
    {
        $settings = SiteSetting::current();
        return view('frontend.academic-result', compact('settings'));
    }

    public function evaluation()
    {
        $settings = SiteSetting::current();
        return view('frontend.evaluation-result', compact('settings'));
    }

    public function boardExam()
    {
        $settings = SiteSetting::current();
        return view('frontend.board-exam-result', compact('settings'));
    }
}
