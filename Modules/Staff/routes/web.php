<?php

use Illuminate\Support\Facades\Route;
use Modules\Staff\Http\Controllers\TeacherController;
use Modules\Staff\Http\Controllers\StaffController;
use Modules\Staff\Http\Controllers\StaffAttendanceController;

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::prefix('staff')->name('staff.')->group(function () {
        Route::resource('teachers', TeacherController::class);
        Route::patch('teachers/{teacher}/toggle', [TeacherController::class, 'toggleActive'])->name('teachers.toggle');

        Route::resource('staffs', StaffController::class);

        Route::get('attendance', [StaffAttendanceController::class, 'index'])->name('attendance.index');
    });
});
