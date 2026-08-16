<?php

namespace Modules\Teacher\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\Academic\Models\AcademicClass;
use Modules\Academic\Models\Section;
use Modules\Academic\Models\Period;
use Modules\Student\Models\Student;
use Modules\Student\Models\StudentAttendance;

class StudentAttendanceController extends Controller
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
        
        $students = [];
        $attendances = [];
        
        if ($request->class_id && $request->section_id && $request->date) {
            $students = Student::where('class_id', $request->class_id)
                ->where('section_id', $request->section_id)
                ->get();
                
            $attendances = StudentAttendance::where('class_id', $request->class_id)
                ->where('section_id', $request->section_id)
                ->where('date', $request->date)
                ->get()
                ->keyBy('student_id');
        }
        
        return Inertia::render('Teacher/Attendance/Index', [
            'classes' => $classes,
            'sections' => $sections,
            'students' => $students,
            'attendances' => $attendances,
            'filters' => $request->only('class_id', 'section_id', 'date'),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:academic_classes,id',
            'section_id' => 'required|exists:sections,id',
            'date' => 'required|date',
            'attendances' => 'required|array',
            'attendances.*.student_id' => 'required|exists:students,id',
            'attendances.*.status' => 'required|in:present,absent',
            'sms_sent' => 'boolean'
        ]);

        $smsSent = $request->boolean('sms_sent');

        foreach ($request->attendances as $attendanceData) {
            StudentAttendance::updateOrCreate(
                [
                    'student_id' => $attendanceData['student_id'],
                    'date' => $request->date,
                    // If period is needed, we would include it here. Leaving out for now.
                ],
                [
                    'class_id' => $request->class_id,
                    'section_id' => $request->section_id,
                    'status' => $attendanceData['status'],
                    'sms_sent' => $smsSent,
                ]
            );
        }

        return redirect()->back()->with('success', 'Attendance saved successfully.');
    }

    public function deleteIndex(Request $request)
    {
        $classes = AcademicClass::all();
        $periods = Period::all();
        
        $sections = [];
        if ($request->class_id) {
            $sections = Section::where('academic_class_id', $request->class_id)->get();
        } else {
            $sections = Section::all();
        }

        return Inertia::render('Teacher/Attendance/Delete', [
            'classes' => $classes,
            'sections' => $sections,
            'periods' => $periods,
            'filters' => $request->only('class_id', 'section_id', 'period_id', 'date'),
        ]);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'section_id' => 'required',
            'date' => 'required|date',
            // period_id optional based on screenshot
        ]);

        $query = StudentAttendance::where('class_id', $request->class_id)
            ->where('section_id', $request->section_id)
            ->where('date', $request->date);
            
        if ($request->period_id) {
            $query->where('period_id', $request->period_id);
        }

        $deletedCount = $query->delete();

        if ($deletedCount > 0) {
            return redirect()->back()->with('success', "{$deletedCount} attendance records deleted.");
        }

        return redirect()->back()->with('error', 'No records found to delete.');
    }
}
