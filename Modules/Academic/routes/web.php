<?php

use Illuminate\Support\Facades\Route;
use Modules\Academic\Http\Controllers\AcademicSessionController;
use Modules\Academic\Http\Controllers\ShiftController;
use Modules\Academic\Http\Controllers\AcademicClassController;
use Modules\Academic\Http\Controllers\AcademicGroupController;
use Modules\Academic\Http\Controllers\SectionController;

use Modules\Academic\Http\Controllers\PeriodController;
use Modules\Academic\Http\Controllers\SubjectController;
use Modules\Academic\Http\Controllers\SubjectConfigController;
use Modules\Academic\Http\Controllers\OptionalSubjectConfigController;
use Modules\Academic\Http\Controllers\StudentOptionalSubjectController;
use Modules\Academic\Http\Controllers\ExamController;
use Modules\Academic\Http\Controllers\StudentCategoryController;
use Modules\Academic\Http\Controllers\DepartmentController;
use Modules\Academic\Http\Controllers\SignatureController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth', 'verified'])->prefix('admin/academic')->name('admin.academic.')->group(function () {
    Route::resource('sessions', AcademicSessionController::class)->except(['show']);
    Route::resource('shifts', ShiftController::class)->except(['show', 'create', 'edit']);
    Route::resource('classes', AcademicClassController::class)->except(['show', 'create', 'edit']);
    Route::resource('groups', AcademicGroupController::class)->except(['show', 'create', 'edit']);
    Route::resource('sections', SectionController::class)->except(['show', 'create', 'edit']);
    
    Route::resource('periods', PeriodController::class)->except(['show', 'create', 'edit']);
    Route::resource('subjects', SubjectController::class)->except(['show']);
    Route::resource('subject-configs', SubjectConfigController::class)->except(['show', 'index', 'edit']);
    Route::resource('optional-subject-configs', OptionalSubjectConfigController::class)->except(['show']);
    Route::resource('student-optional-subjects', StudentOptionalSubjectController::class)->except(['show', 'edit', 'update']);
    Route::resource('exams', ExamController::class)->except(['show', 'create', 'edit']);
    Route::resource('student-categories', StudentCategoryController::class)->except(['show', 'create', 'edit']);
    Route::resource('departments', DepartmentController::class)->except(['show', 'create', 'edit']);
    Route::resource('signatures', SignatureController::class)->except(['show', 'create', 'edit']);
});
