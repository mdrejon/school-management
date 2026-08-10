<?php

use Illuminate\Support\Facades\Route;
use Modules\Student\Http\Controllers\StudentController;

use Modules\Student\Http\Controllers\StudentMigrationController;
use Modules\Student\Http\Controllers\StudentReportController;

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('students/at-a-glance', [StudentReportController::class, 'atAGlance'])->name('students.at-a-glance');
    
    Route::get('students/migration', [StudentMigrationController::class, 'index'])->name('students.migration');
    Route::post('students/migration/process', [StudentMigrationController::class, 'processMigration'])->name('students.migration.process');
    
    Route::get('students/migration-pushback', [StudentMigrationController::class, 'pushback'])->name('students.migration.pushback');
    Route::post('students/migration-pushback/process', [StudentMigrationController::class, 'processPushback'])->name('students.migration.pushback.process');
    
    Route::get('students/migrated-list', [StudentMigrationController::class, 'migratedList'])->name('students.migrated-list');

    Route::resource('students', StudentController::class);
});
