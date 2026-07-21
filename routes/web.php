<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GalleryImageController;
use App\Http\Controllers\TeacherController;
use App\Models\Course;
use App\Models\CoursePageSetting;
use App\Models\Department;
use App\Models\DepartmentPageSetting;
use App\Models\Event;
use App\Models\EventPageSetting;
use App\Models\GalleryImage;
use App\Models\GalleryPageSetting;
use App\Models\Slider;
use App\Models\Teacher;
use App\Models\TeacherPageSetting;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return view('frontend.home', [
        'sliders' => Slider::forHomepage(),
        'courses' => Course::forHomepage(),
        'coursePageSettings' => CoursePageSetting::current(),
        'teachers' => Teacher::forHomepage(),
        'teacherPageSettings' => TeacherPageSetting::current(),
        'galleryImages' => GalleryImage::forHomepage(),
        'galleryPageSettings' => GalleryPageSetting::current(),
        'events' => Event::forHomepage(),
        'eventPageSettings' => EventPageSetting::current(),
        'departments' => Department::forHomepage(),
        'departmentPageSettings' => DepartmentPageSetting::current(),
    ]);
})->name('home');

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course:slug}', [CourseController::class, 'show'])->name('courses.show');

Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
Route::get('/teachers/{teacher:slug}', [TeacherController::class, 'show'])->name('teachers.show');

Route::get('/gallery', [GalleryImageController::class, 'index'])->name('gallery.index');

Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event:slug}', [EventController::class, 'show'])->name('events.show');

Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
Route::get('/departments/{department:slug}', [DepartmentController::class, 'show'])->name('departments.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

require __DIR__.'/admin.php';
