<?php

use Illuminate\Support\Facades\Route;
use Modules\Teacher\Http\Controllers\DashboardController;

Route::middleware(['auth', 'verified'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('profile', fn () => \Inertia\Inertia::render('Profile/Show', ['sessions' => []]))->name('profile');

    // Student Attendance
    Route::get('attendance', [\Modules\Teacher\Http\Controllers\StudentAttendanceController::class, 'index'])->name('attendance.index');
    Route::post('attendance', [\Modules\Teacher\Http\Controllers\StudentAttendanceController::class, 'store'])->name('attendance.store');
    
    Route::get('attendance/delete', [\Modules\Teacher\Http\Controllers\StudentAttendanceController::class, 'deleteIndex'])->name('attendance.delete');
    Route::delete('attendance', [\Modules\Teacher\Http\Controllers\StudentAttendanceController::class, 'destroy'])->name('attendance.destroy');

    // Exam Attendance
    Route::get('exam-attendance', [\Modules\Teacher\Http\Controllers\ExamAttendanceController::class, 'index'])->name('exam-attendance.index');
    Route::post('exam-attendance', [\Modules\Teacher\Http\Controllers\ExamAttendanceController::class, 'store'])->name('exam-attendance.store');

    // Attendance Report
    Route::get('attendance-report', [\Modules\Teacher\Http\Controllers\AttendanceReportController::class, 'index'])->name('attendance-report.index');

    // Assignments
    Route::resource('assignments', \Modules\Teacher\Http\Controllers\AssignmentController::class)->except(['show']);

    // Syllabuses
    Route::get('syllabuses/{syllabus}/download', [\Modules\Teacher\Http\Controllers\SyllabusController::class, 'download'])->name('syllabuses.download');
    Route::resource('syllabuses', \Modules\Teacher\Http\Controllers\SyllabusController::class)->except(['show', 'edit', 'update']);

    // Resources
    Route::resource('resources', \Modules\Teacher\Http\Controllers\ResourceController::class)->except(['show', 'edit', 'update']);

    // Class Lessons
    Route::resource('class-lessons', \Modules\Teacher\Http\Controllers\ClassLessonController::class)->except(['show', 'edit', 'update']);

    // Prayers
    Route::get('prayers/{prayer}/download', [\Modules\Teacher\Http\Controllers\PrayerController::class, 'download'])->name('prayers.download');
    Route::resource('prayers', \Modules\Teacher\Http\Controllers\PrayerController::class)->except(['show', 'edit', 'update']);

    // Behaviors
    Route::get('behaviors/{behavior}/download', [\Modules\Teacher\Http\Controllers\BehaviorController::class, 'download'])->name('behaviors.download');
    Route::resource('behaviors', \Modules\Teacher\Http\Controllers\BehaviorController::class)->except(['show']);

    // Exam Module (Teacher)
    Route::prefix('exam-module')->name('exam-module.')->group(function () {
        Route::prefix('mark-input')->name('mark-input.')->group(function () {
            Route::get('/', [\Modules\Exam\Http\Controllers\Teacher\MarkInputController::class, 'index'])->name('index');
            Route::get('/{classId}', [\Modules\Exam\Http\Controllers\Teacher\MarkInputController::class, 'show'])->name('show');
            Route::post('/fetch-students', [\Modules\Exam\Http\Controllers\Teacher\MarkInputController::class, 'fetchStudents'])->name('fetchStudents');
            Route::post('/store', [\Modules\Exam\Http\Controllers\Teacher\MarkInputController::class, 'store'])->name('store');
        });

        Route::prefix('exam-result')->name('exam-result.')->group(function () {
            Route::get('/', [\Modules\Exam\Http\Controllers\Teacher\ExamResultController::class, 'index'])->name('index');
            Route::post('/fetch-results', [\Modules\Exam\Http\Controllers\Teacher\ExamResultController::class, 'fetchResults'])->name('fetchResults');
        });
    });

    // Academic Module (Teacher)
    Route::prefix('academic')->name('academic.')->group(function () {
        Route::get('/my-routine', [\Modules\Academic\Http\Controllers\Teacher\ClassRoutineController::class, 'myRoutine'])->name('class-routine.my');
    });
});
