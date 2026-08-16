<?php

use Illuminate\Support\Facades\Route;
use Modules\Student\Http\Controllers\StudentController;

use Modules\Student\Http\Controllers\StudentMigrationController;
use Modules\Student\Http\Controllers\StudentReportController;

Route::middleware(['auth', 'verified', 'role:admin|system_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('students/at-a-glance', [StudentReportController::class, 'atAGlance'])->name('students.at-a-glance');
    
    Route::get('students/migration', [StudentMigrationController::class, 'index'])->name('students.migration');
    Route::post('students/migration/process', [StudentMigrationController::class, 'processMigration'])->name('students.migration.process');
    
    Route::get('students/migration-pushback', [StudentMigrationController::class, 'pushback'])->name('students.migration.pushback');
    Route::post('students/migration-pushback/process', [StudentMigrationController::class, 'processPushback'])->name('students.migration.pushback.process');
    
    Route::get('students/migrated-list', [StudentMigrationController::class, 'migratedList'])->name('students.migrated-list');

    Route::resource('students', StudentController::class);
    
    // Attendance
    Route::get('attendance', [\Modules\Student\Http\Controllers\Admin\StudentAttendanceController::class, 'index'])->name('students.attendance.index');
    Route::post('attendance', [\Modules\Student\Http\Controllers\Admin\StudentAttendanceController::class, 'store'])->name('students.attendance.store');
    Route::get('attendance/delete', [\Modules\Student\Http\Controllers\Admin\StudentAttendanceController::class, 'deleteIndex'])->name('students.attendance.delete');
    Route::delete('attendance', [\Modules\Student\Http\Controllers\Admin\StudentAttendanceController::class, 'destroy'])->name('students.attendance.destroy');

    Route::get('exam-attendance', [\Modules\Student\Http\Controllers\Admin\ExamAttendanceController::class, 'index'])->name('students.exam-attendance.index');
    Route::post('exam-attendance', [\Modules\Student\Http\Controllers\Admin\ExamAttendanceController::class, 'store'])->name('students.exam-attendance.store');

    Route::get('attendance-report', [\Modules\Student\Http\Controllers\Admin\AttendanceReportController::class, 'index'])->name('students.attendance-report.index');
});

Route::middleware(['auth', 'verified', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('dashboard', [\Modules\Student\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', fn () => \Inertia\Inertia::render('Profile/Show', ['sessions' => []]))->name('profile');
    Route::get('assignments/submissions', [\Modules\Student\Http\Controllers\AssignmentController::class, 'submissions'])->name('assignments.submissions');
    Route::resource('assignments', \Modules\Student\Http\Controllers\AssignmentController::class)->only(['index', 'create', 'store']);
    Route::get('syllabus', [\Modules\Student\Http\Controllers\SyllabusController::class, 'index'])->name('syllabus.index');
    Route::get('subjects', [\Modules\Student\Http\Controllers\SubjectController::class, 'index'])->name('subjects.index');
    Route::get('class-routine', [\Modules\Student\Http\Controllers\ClassRoutineController::class, 'index'])->name('class-routine.index');
    Route::get('exam-routine', [\Modules\Student\Http\Controllers\ExamRoutineController::class, 'index'])->name('exam-routine.index');
});
