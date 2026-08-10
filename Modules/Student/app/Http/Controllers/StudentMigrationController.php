<?php

namespace Modules\Student\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Student\Models\Student;
use Modules\Student\Models\StudentMigration;
use Inertia\Inertia;

class StudentMigrationController extends Controller
{
    public function index()
    {
        // Fetch users to potentially migrate (e.g., all students, or filter via query params)
        $students = Student::with('user')->get();
        return Inertia::render('Admin/Student/Migration', [
            'students' => $students
        ]);
    }

    public function processMigration(Request $request)
    {
        $request->validate([
            'from_class_id' => 'nullable|integer',
            'from_section_id' => 'nullable|integer',
            'to_class_id' => 'required|integer',
            'to_section_id' => 'required|integer',
            'academic_year' => 'nullable|string',
            'migration_type' => 'required|string',
            'student_ids' => 'required|array',
            'student_ids.*' => 'exists:students,id',
        ]);

        foreach ($request->student_ids as $studentId) {
            $student = Student::findOrFail($studentId);
            
            // Record the migration
            StudentMigration::create([
                'student_id' => $student->id,
                'from_class_id' => $student->class_id,
                'from_section_id' => $student->section_id,
                'to_class_id' => $request->to_class_id,
                'to_section_id' => $request->to_section_id,
                'academic_year' => $request->academic_year,
                'migration_type' => $request->migration_type,
            ]);

            // Update student current class
            $student->update([
                'class_id' => $request->to_class_id,
                'section_id' => $request->to_section_id,
            ]);
        }

        return redirect()->back()->with('success', 'Students migrated successfully.');
    }

    public function pushback()
    {
        // Show recently migrated students
        $migrations = StudentMigration::with(['student.user'])->latest()->get();
        return Inertia::render('Admin/Student/MigrationPushback', [
            'migrations' => $migrations
        ]);
    }

    public function processPushback(Request $request)
    {
        $request->validate([
            'migration_ids' => 'required|array',
            'migration_ids.*' => 'exists:student_migrations,id',
        ]);

        foreach ($request->migration_ids as $migrationId) {
            $migration = StudentMigration::findOrFail($migrationId);
            $student = $migration->student;

            // Revert student to previous class/section
            if ($student) {
                $student->update([
                    'class_id' => $migration->from_class_id,
                    'section_id' => $migration->from_section_id,
                ]);
            }

            // Remove migration record
            $migration->delete();
        }

        return redirect()->back()->with('success', 'Migration pushback completed successfully.');
    }

    public function migratedList(Request $request)
    {
        $query = StudentMigration::with(['student.user']);
        
        if ($request->has('academic_year') && $request->academic_year) {
            $query->where('academic_year', $request->academic_year);
        }

        if ($request->has('section_id') && $request->section_id !== 'all') {
            $query->where('to_section_id', $request->section_id);
        }

        $migrations = $query->latest()->get();

        return Inertia::render('Admin/Student/MigratedList', [
            'migrations' => $migrations,
            'filters' => $request->only(['academic_year', 'section_id'])
        ]);
    }
}
