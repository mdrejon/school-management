<?php

namespace Modules\Teacher\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\Academic\Models\AcademicClass;
use Modules\Academic\Models\Section;
use Modules\Student\Models\Student;
use Modules\Student\Models\StudentAttendance;

class AttendanceReportController extends Controller
{
    public function index(Request $request)
    {
        $classes = AcademicClass::all();
        
        $sections = [];
        if ($request->class_id) {
            $sections = Section::where('academic_class_id', $request->class_id)->get();
        } else {
            $sections = Section::all();
        }

        $report = [];
        
        if ($request->class_id && $request->section_id && $request->from_date && $request->to_date) {
            $students = Student::where('class_id', $request->class_id)
                ->where('section_id', $request->section_id)
                ->get();
                
            $attendances = StudentAttendance::where('class_id', $request->class_id)
                ->where('section_id', $request->section_id)
                ->whereBetween('date', [$request->from_date, $request->to_date])
                ->get();

            $totalDays = $attendances->pluck('date')->unique()->count();
            
            foreach ($students as $student) {
                $studentAttendances = $attendances->where('student_id', $student->id);
                $presentCount = $studentAttendances->where('status', 'present')->count();
                $absentCount = $studentAttendances->where('status', 'absent')->count();
                
                $percentage = $totalDays > 0 ? round(($presentCount / $totalDays) * 100, 2) : 0;
                
                // Filter by percentage if provided
                if ($request->percentage && $percentage < $request->percentage) {
                    continue; // Skip this student if their percentage is lower than the threshold
                }

                $report[] = [
                    'student' => $student,
                    'present_count' => $presentCount,
                    'absent_count' => $absentCount,
                    'percentage' => $percentage,
                ];
            }
        }
        
        return Inertia::render('Teacher/Attendance/Report', [
            'classes' => $classes,
            'sections' => $sections,
            'report' => $report,
            'filters' => $request->only('class_id', 'section_id', 'from_date', 'to_date', 'percentage'),
        ]);
    }
}
