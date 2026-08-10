<?php

namespace Modules\Exam\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\Academic\Models\AcademicClass;
use Modules\Exam\Models\GlobalExamCode;
use Modules\Exam\Models\GlobalExamGrade;
use Modules\Exam\Models\GlobalExam;
use Modules\Exam\Models\ClassExamCode;
use Modules\Exam\Models\ClassExamGrade;
use Modules\Exam\Models\ClassExam;

class ExamStartupController extends Controller
{
    public function index()
    {
        $classes = AcademicClass::all();
        $globalExamCodes = GlobalExamCode::all();
        $globalExamGrades = GlobalExamGrade::all();
        $globalExams = GlobalExam::all();

        // Load existing configurations for the tables
        $classExamCodes = ClassExamCode::with(['academicClass', 'globalExamCode'])->get();
        $classExamGrades = ClassExamGrade::with(['academicClass', 'globalExamGrade'])->get();
        $classExams = ClassExam::with(['academicClass', 'globalExam'])->get();

        return Inertia::render('Admin/Exam/Startup/Index', [
            'classes' => $classes,
            'globalExamCodes' => $globalExamCodes,
            'globalExamGrades' => $globalExamGrades,
            'globalExams' => $globalExams,
            'classExamCodes' => $classExamCodes,
            'classExamGrades' => $classExamGrades,
            'classExams' => $classExams,
        ]);
    }

    public function storeCodes(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:academic_classes,id',
            'global_exam_code_ids' => 'required|array',
            'global_exam_code_ids.*' => 'exists:global_exam_codes,id',
        ]);

        $classId = $request->class_id;

        // Sync (Remove old, add new)
        ClassExamCode::where('class_id', $classId)->delete();

        $data = [];
        foreach ($request->global_exam_code_ids as $codeId) {
            $data[] = [
                'class_id' => $classId,
                'global_exam_code_id' => $codeId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        ClassExamCode::insert($data);

        return redirect()->back()->with('success', 'Exam Codes assigned successfully.');
    }

    public function storeGrades(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:academic_classes,id',
            'global_exam_grade_ids' => 'required|array',
            'global_exam_grade_ids.*' => 'exists:global_exam_grades,id',
        ]);

        $classId = $request->class_id;

        // Sync
        ClassExamGrade::where('class_id', $classId)->delete();

        $data = [];
        foreach ($request->global_exam_grade_ids as $gradeId) {
            $data[] = [
                'class_id' => $classId,
                'global_exam_grade_id' => $gradeId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        ClassExamGrade::insert($data);

        return redirect()->back()->with('success', 'Exam Grades assigned successfully.');
    }

    public function storeExams(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:academic_classes,id',
            'global_exam_id' => 'required|exists:global_exams,id',
            'merit_type' => 'required|string',
        ]);

        ClassExam::updateOrCreate(
            [
                'class_id' => $request->class_id,
                'global_exam_id' => $request->global_exam_id,
            ],
            [
                'merit_type' => $request->merit_type,
            ]
        );

        return redirect()->back()->with('success', 'Exam created successfully.');
    }
}
