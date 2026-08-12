<?php

use Illuminate\Support\Facades\Route;
use Modules\Student\Http\Controllers\StudentController;

use Modules\Student\Http\Controllers\StudentMigrationController;
use Modules\Student\Http\Controllers\StudentReportController;

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('students/at-a-glance', [StudentReportController::class, 'atAGlance'])->name('students.at-a-glance');
    
    Route::get('students/migration', [StudentMigrationController::class, 'index'])->name('students.migration');
    Route::post('students/migration/process', [StudentMigrationController::class, 'processMigration'])->name('students.migration.process');
    
    Route::get('students/migration-pushback', [StudentMigrationController::class, 'pushback'])->name('students.migration.pushback');
    Route::post('students/migration-pushback/process', [StudentMigrationController::class, 'processPushback'])->name('students.migration.pushback.process');
    
    Route::get('students/migrated-list', [StudentMigrationController::class, 'migratedList'])->name('students.migrated-list');

    Route::resource('students', StudentController::class);
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
