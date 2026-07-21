<?php

use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CoursePageSettingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DepartmentPageSettingController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\EventPageSettingController;
use App\Http\Controllers\Admin\GalleryImageController;
use App\Http\Controllers\Admin\GalleryPageSettingController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\TeacherPageSettingController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('settings/languages')->name('settings.languages.')->group(function () {
        Route::get('/', [LanguageController::class, 'index'])->name('index');
        Route::post('/', [LanguageController::class, 'store'])->name('store');
        Route::put('/{language}', [LanguageController::class, 'update'])->name('update');
        Route::patch('/{language}/toggle', [LanguageController::class, 'toggleActive'])->name('toggle');
        Route::patch('/{language}/default', [LanguageController::class, 'makeDefault'])->name('default');
        Route::patch('/{language}/move-up', [LanguageController::class, 'moveUp'])->name('moveUp');
        Route::patch('/{language}/move-down', [LanguageController::class, 'moveDown'])->name('moveDown');
        Route::delete('/{language}', [LanguageController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('cms/sliders')->name('cms.sliders.')->group(function () {
        Route::get('/', [SliderController::class, 'index'])->name('index');
        Route::post('/', [SliderController::class, 'store'])->name('store');
        Route::put('/{slider}', [SliderController::class, 'update'])->name('update');
        Route::patch('/{slider}/toggle', [SliderController::class, 'toggleActive'])->name('toggle');
        Route::patch('/{slider}/move-up', [SliderController::class, 'moveUp'])->name('moveUp');
        Route::patch('/{slider}/move-down', [SliderController::class, 'moveDown'])->name('moveDown');
        Route::delete('/{slider}', [SliderController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('settings/website')->name('settings.website.')->group(function () {
        Route::get('/', [SiteSettingController::class, 'edit'])->name('edit');
        Route::put('/', [SiteSettingController::class, 'update'])->name('update');
    });

    Route::prefix('cms/courses')->name('cms.courses.')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('index');
        Route::get('/create', [CourseController::class, 'create'])->name('create');
        Route::get('/{course}/edit', [CourseController::class, 'edit'])->name('edit');
        Route::post('/', [CourseController::class, 'store'])->name('store');
        Route::put('/{course}', [CourseController::class, 'update'])->name('update');
        Route::patch('/{course}/toggle', [CourseController::class, 'toggleActive'])->name('toggle');
        Route::patch('/{course}/move-up', [CourseController::class, 'moveUp'])->name('moveUp');
        Route::patch('/{course}/move-down', [CourseController::class, 'moveDown'])->name('moveDown');
        Route::delete('/{course}', [CourseController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('cms/courses-settings')->name('cms.courses.settings.')->group(function () {
        Route::put('/', [CoursePageSettingController::class, 'update'])->name('update');
    });

    Route::prefix('cms/teachers')->name('cms.teachers.')->group(function () {
        Route::get('/', [TeacherController::class, 'index'])->name('index');
        Route::get('/create', [TeacherController::class, 'create'])->name('create');
        Route::get('/{teacher}/edit', [TeacherController::class, 'edit'])->name('edit');
        Route::post('/', [TeacherController::class, 'store'])->name('store');
        Route::put('/{teacher}', [TeacherController::class, 'update'])->name('update');
        Route::patch('/{teacher}/toggle', [TeacherController::class, 'toggleActive'])->name('toggle');
        Route::patch('/{teacher}/move-up', [TeacherController::class, 'moveUp'])->name('moveUp');
        Route::patch('/{teacher}/move-down', [TeacherController::class, 'moveDown'])->name('moveDown');
        Route::delete('/{teacher}', [TeacherController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('cms/teachers-settings')->name('cms.teachers.settings.')->group(function () {
        Route::put('/', [TeacherPageSettingController::class, 'update'])->name('update');
    });

    Route::prefix('cms/gallery')->name('cms.gallery.')->group(function () {
        Route::get('/', [GalleryImageController::class, 'index'])->name('index');
        Route::get('/create', [GalleryImageController::class, 'create'])->name('create');
        Route::get('/{galleryImage}/edit', [GalleryImageController::class, 'edit'])->name('edit');
        Route::post('/', [GalleryImageController::class, 'store'])->name('store');
        Route::put('/{galleryImage}', [GalleryImageController::class, 'update'])->name('update');
        Route::patch('/{galleryImage}/toggle', [GalleryImageController::class, 'toggleActive'])->name('toggle');
        Route::patch('/{galleryImage}/move-up', [GalleryImageController::class, 'moveUp'])->name('moveUp');
        Route::patch('/{galleryImage}/move-down', [GalleryImageController::class, 'moveDown'])->name('moveDown');
        Route::delete('/{galleryImage}', [GalleryImageController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('cms/gallery-settings')->name('cms.gallery.settings.')->group(function () {
        Route::put('/', [GalleryPageSettingController::class, 'update'])->name('update');
    });

    Route::prefix('cms/events')->name('cms.events.')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('index');
        Route::get('/create', [EventController::class, 'create'])->name('create');
        Route::get('/{event}/edit', [EventController::class, 'edit'])->name('edit');
        Route::post('/', [EventController::class, 'store'])->name('store');
        Route::put('/{event}', [EventController::class, 'update'])->name('update');
        Route::patch('/{event}/toggle', [EventController::class, 'toggleActive'])->name('toggle');
        Route::patch('/{event}/move-up', [EventController::class, 'moveUp'])->name('moveUp');
        Route::patch('/{event}/move-down', [EventController::class, 'moveDown'])->name('moveDown');
        Route::delete('/{event}', [EventController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('cms/events-settings')->name('cms.events.settings.')->group(function () {
        Route::put('/', [EventPageSettingController::class, 'update'])->name('update');
    });

    Route::prefix('cms/departments')->name('cms.departments.')->group(function () {
        Route::get('/', [DepartmentController::class, 'index'])->name('index');
        Route::get('/create', [DepartmentController::class, 'create'])->name('create');
        Route::get('/{department}/edit', [DepartmentController::class, 'edit'])->name('edit');
        Route::post('/', [DepartmentController::class, 'store'])->name('store');
        Route::put('/{department}', [DepartmentController::class, 'update'])->name('update');
        Route::patch('/{department}/toggle', [DepartmentController::class, 'toggleActive'])->name('toggle');
        Route::patch('/{department}/move-up', [DepartmentController::class, 'moveUp'])->name('moveUp');
        Route::patch('/{department}/move-down', [DepartmentController::class, 'moveDown'])->name('moveDown');
        Route::delete('/{department}', [DepartmentController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('cms/departments-settings')->name('cms.departments.settings.')->group(function () {
        Route::put('/', [DepartmentPageSettingController::class, 'update'])->name('update');
    });

    // Modules below are navigable from the sidebar but not built out yet.
    // Each renders a placeholder page until its real controller/pages are implemented.
    $stubs = [
        // Temporarily hidden — not built out yet.
        // 'academic.classes' => ['classes', 'Classes'],
        // 'academic.sections' => ['sections', 'Sections'],
        // 'academic.subjects' => ['subjects', 'Subjects'],
        // 'academic.routine' => ['routine', 'Class Routine'],
        // 'academic.exams' => ['exams', 'Exams'],
        // 'academic.results' => ['results', 'Results'],
        // 'academic.attendance' => ['attendance', 'Attendance'],

        // 'people.students' => ['students', 'Students'],
        // 'people.teachers' => ['teachers', 'Teachers'],
        // 'people.staff' => ['staff', 'Staff'],
        // 'people.parents' => ['parents', 'Parents'],
        // 'people.admissions' => ['admissions', 'Admissions'],

        'cms.pages' => ['cms/pages', 'Pages'],
        'cms.news' => ['cms/news', 'News & Events'],
        'cms.notices' => ['cms/notices', 'Notices'],
        'cms.testimonials' => ['cms/testimonials', 'Testimonials'],
        'cms.faq' => ['cms/faq', 'FAQ'],
        'cms.downloads' => ['cms/downloads', 'Downloads'],
        'cms.menus' => ['cms/menus', 'Menus'],

        // Temporarily hidden — not built out yet.
        // 'finance.fees' => ['finance/fees', 'Fee Structure'],
        // 'finance.invoices' => ['finance/invoices', 'Invoices'],
        // 'finance.payments' => ['finance/payments', 'Payments'],
        // 'finance.expenses' => ['finance/expenses', 'Expenses'],

        // 'hr.payroll' => ['hr/payroll', 'Payroll'],
        // 'hr.leave' => ['hr/leave', 'Leave Requests'],

        // 'communication.messages' => ['communication/messages', 'Contact Messages'],
        // 'communication.announcements' => ['communication/announcements', 'Announcements'],

        'settings.users' => ['settings/users', 'Users & Roles'],
        'settings.permissions' => ['settings/permissions', 'Permissions'],
        'settings.general' => ['settings/general', 'General Settings'],
    ];

    foreach ($stubs as $name => [$uri, $title]) {
        Route::get("/{$uri}", fn () => Inertia::render('Admin/ComingSoon', ['title' => $title]))->name($name);
    }
});
