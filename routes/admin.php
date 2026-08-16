<?php

use App\Http\Controllers\Admin\BlogPageSettingController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\CampusTourPageSettingController;
use App\Http\Controllers\Admin\ClassScheduleController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CoursePageSettingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DepartmentPageSettingController;
use App\Http\Controllers\Admin\DonorController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\EventPageSettingController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\FacilityPageSettingController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FaqPageSettingController;
use App\Http\Controllers\Admin\FounderController;
use App\Http\Controllers\Admin\FounderDonorPageSettingController;
use App\Http\Controllers\Admin\GalleryImageController;
use App\Http\Controllers\Admin\GalleryPageSettingController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ModuleSettingController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\NoticePageSettingController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PageVisualBuilderController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\PortfolioPageSettingController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\VisionMissionPageSettingController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\TeacherPageSettingController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\TestimonialPageSettingController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:admin|system_admin',
])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('settings/languages')->name('settings.languages.')->group(function () {
        Route::get('/', [LanguageController::class, 'index'])->name('index')->middleware('permission:languages.view');
        Route::post('/', [LanguageController::class, 'store'])->name('store')->middleware('permission:languages.create');
        Route::put('/{language}', [LanguageController::class, 'update'])->name('update')->middleware('permission:languages.edit');
        Route::patch('/{language}/toggle', [LanguageController::class, 'toggleActive'])->name('toggle')->middleware('permission:languages.edit');
        Route::patch('/{language}/default', [LanguageController::class, 'makeDefault'])->name('default')->middleware('permission:languages.edit');
        Route::patch('/{language}/move-up', [LanguageController::class, 'moveUp'])->name('moveUp')->middleware('permission:languages.edit');
        Route::patch('/{language}/move-down', [LanguageController::class, 'moveDown'])->name('moveDown')->middleware('permission:languages.edit');
        Route::delete('/{language}', [LanguageController::class, 'destroy'])->name('destroy')->middleware('permission:languages.delete');
    });

    Route::prefix('cms/sliders')->name('cms.sliders.')->middleware('module:slider')->group(function () {
        Route::get('/', [SliderController::class, 'index'])->name('index')->middleware('permission:slider.view');
        Route::post('/', [SliderController::class, 'store'])->name('store')->middleware('permission:slider.create');
        Route::put('/{slider}', [SliderController::class, 'update'])->name('update')->middleware('permission:slider.edit');
        Route::patch('/{slider}/toggle', [SliderController::class, 'toggleActive'])->name('toggle')->middleware('permission:slider.edit');
        Route::patch('/{slider}/move-up', [SliderController::class, 'moveUp'])->name('moveUp')->middleware('permission:slider.edit');
        Route::patch('/{slider}/move-down', [SliderController::class, 'moveDown'])->name('moveDown')->middleware('permission:slider.edit');
        Route::delete('/{slider}', [SliderController::class, 'destroy'])->name('destroy')->middleware('permission:slider.delete');
    });

    Route::prefix('settings/website')->name('settings.website.')->group(function () {
        Route::get('/', [SiteSettingController::class, 'edit'])->name('edit')->middleware('permission:website_options.view');
        Route::put('/', [SiteSettingController::class, 'update'])->name('update')->middleware('permission:website_options.edit');
    });

    Route::prefix('settings/modules')->name('settings.modules.')->group(function () {
        Route::get('/', [ModuleSettingController::class, 'edit'])->name('edit')->middleware('permission:site_configuration.view');
        Route::put('/', [ModuleSettingController::class, 'update'])->name('update')->middleware('permission:site_configuration.edit');
    });

    Route::prefix('settings/users')->name('settings.users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index')->middleware('permission:users.view');
        Route::post('/', [UserController::class, 'store'])->name('store')->middleware('permission:users.create');
        Route::put('/{user}', [UserController::class, 'update'])->name('update')->middleware('permission:users.edit');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy')->middleware('permission:users.delete');
    });

    Route::prefix('settings/permissions')->name('settings.permissions.')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('index')->middleware('permission:roles.view');
        Route::get('/create', [RoleController::class, 'create'])->name('create')->middleware('permission:roles.create');
        Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('edit')->middleware('permission:roles.edit');
        Route::post('/', [RoleController::class, 'store'])->name('store')->middleware('permission:roles.create');
        Route::put('/{role}', [RoleController::class, 'update'])->name('update')->middleware('permission:roles.edit');
        Route::delete('/{role}', [RoleController::class, 'destroy'])->name('destroy')->middleware('permission:roles.delete');
    });

    Route::prefix('cms/courses')->name('cms.courses.')->middleware('module:courses')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('index')->middleware('permission:courses.view');
        Route::get('/create', [CourseController::class, 'create'])->name('create')->middleware('permission:courses.create');
        Route::get('/{course}/edit', [CourseController::class, 'edit'])->name('edit')->middleware('permission:courses.edit');
        Route::post('/', [CourseController::class, 'store'])->name('store')->middleware('permission:courses.create');
        Route::put('/{course}', [CourseController::class, 'update'])->name('update')->middleware('permission:courses.edit');
        Route::patch('/{course}/toggle', [CourseController::class, 'toggleActive'])->name('toggle')->middleware('permission:courses.edit');
        Route::patch('/{course}/move-up', [CourseController::class, 'moveUp'])->name('moveUp')->middleware('permission:courses.edit');
        Route::patch('/{course}/move-down', [CourseController::class, 'moveDown'])->name('moveDown')->middleware('permission:courses.edit');
        Route::delete('/{course}', [CourseController::class, 'destroy'])->name('destroy')->middleware('permission:courses.delete');
    });

    Route::prefix('cms/courses-settings')->name('cms.courses.settings.')->middleware(['module:courses', 'permission:courses.edit'])->group(function () {
        Route::put('/', [CoursePageSettingController::class, 'update'])->name('update');
    });

    Route::prefix('cms/teachers')->name('cms.teachers.')->middleware('module:teachers')->group(function () {
        Route::get('/', [TeacherController::class, 'index'])->name('index')->middleware('permission:teachers.view');
        Route::get('/create', [TeacherController::class, 'create'])->name('create')->middleware('permission:teachers.create');
        Route::get('/{teacher}/edit', [TeacherController::class, 'edit'])->name('edit')->middleware('permission:teachers.edit');
        Route::post('/', [TeacherController::class, 'store'])->name('store')->middleware('permission:teachers.create');
        Route::put('/{teacher}', [TeacherController::class, 'update'])->name('update')->middleware('permission:teachers.edit');
        Route::patch('/{teacher}/toggle', [TeacherController::class, 'toggleActive'])->name('toggle')->middleware('permission:teachers.edit');
        Route::patch('/{teacher}/move-up', [TeacherController::class, 'moveUp'])->name('moveUp')->middleware('permission:teachers.edit');
        Route::patch('/{teacher}/move-down', [TeacherController::class, 'moveDown'])->name('moveDown')->middleware('permission:teachers.edit');
        Route::delete('/{teacher}', [TeacherController::class, 'destroy'])->name('destroy')->middleware('permission:teachers.delete');
    });

    Route::prefix('cms/teachers-settings')->name('cms.teachers.settings.')->middleware(['module:teachers', 'permission:teachers.edit'])->group(function () {
        Route::put('/', [TeacherPageSettingController::class, 'update'])->name('update');
    });

    Route::prefix('cms/gallery')->name('cms.gallery.')->middleware('module:gallery')->group(function () {
        Route::get('/', [GalleryImageController::class, 'index'])->name('index')->middleware('permission:gallery.view');
        Route::get('/create', [GalleryImageController::class, 'create'])->name('create')->middleware('permission:gallery.create');
        Route::get('/{galleryImage}/edit', [GalleryImageController::class, 'edit'])->name('edit')->middleware('permission:gallery.edit');
        Route::post('/', [GalleryImageController::class, 'store'])->name('store')->middleware('permission:gallery.create');
        Route::put('/{galleryImage}', [GalleryImageController::class, 'update'])->name('update')->middleware('permission:gallery.edit');
        Route::patch('/{galleryImage}/toggle', [GalleryImageController::class, 'toggleActive'])->name('toggle')->middleware('permission:gallery.edit');
        Route::patch('/{galleryImage}/move-up', [GalleryImageController::class, 'moveUp'])->name('moveUp')->middleware('permission:gallery.edit');
        Route::patch('/{galleryImage}/move-down', [GalleryImageController::class, 'moveDown'])->name('moveDown')->middleware('permission:gallery.edit');
        Route::delete('/{galleryImage}', [GalleryImageController::class, 'destroy'])->name('destroy')->middleware('permission:gallery.delete');
    });

    Route::prefix('cms/gallery-settings')->name('cms.gallery.settings.')->middleware(['module:gallery', 'permission:gallery.edit'])->group(function () {
        Route::put('/', [GalleryPageSettingController::class, 'update'])->name('update');
    });

    Route::prefix('cms/events')->name('cms.events.')->middleware('module:events')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('index')->middleware('permission:events.view');
        Route::get('/create', [EventController::class, 'create'])->name('create')->middleware('permission:events.create');
        Route::get('/{event}/edit', [EventController::class, 'edit'])->name('edit')->middleware('permission:events.edit');
        Route::post('/', [EventController::class, 'store'])->name('store')->middleware('permission:events.create');
        Route::put('/{event}', [EventController::class, 'update'])->name('update')->middleware('permission:events.edit');
        Route::patch('/{event}/toggle', [EventController::class, 'toggleActive'])->name('toggle')->middleware('permission:events.edit');
        Route::patch('/{event}/move-up', [EventController::class, 'moveUp'])->name('moveUp')->middleware('permission:events.edit');
        Route::patch('/{event}/move-down', [EventController::class, 'moveDown'])->name('moveDown')->middleware('permission:events.edit');
        Route::delete('/{event}', [EventController::class, 'destroy'])->name('destroy')->middleware('permission:events.delete');
    });

    Route::prefix('cms/events-settings')->name('cms.events.settings.')->middleware(['module:events', 'permission:events.edit'])->group(function () {
        Route::put('/', [EventPageSettingController::class, 'update'])->name('update');
    });

    Route::prefix('cms/departments')->name('cms.departments.')->middleware('module:departments')->group(function () {
        Route::get('/', [DepartmentController::class, 'index'])->name('index')->middleware('permission:departments.view');
        Route::get('/create', [DepartmentController::class, 'create'])->name('create')->middleware('permission:departments.create');
        Route::get('/{department}/edit', [DepartmentController::class, 'edit'])->name('edit')->middleware('permission:departments.edit');
        Route::post('/', [DepartmentController::class, 'store'])->name('store')->middleware('permission:departments.create');
        Route::put('/{department}', [DepartmentController::class, 'update'])->name('update')->middleware('permission:departments.edit');
        Route::patch('/{department}/toggle', [DepartmentController::class, 'toggleActive'])->name('toggle')->middleware('permission:departments.edit');
        Route::patch('/{department}/move-up', [DepartmentController::class, 'moveUp'])->name('moveUp')->middleware('permission:departments.edit');
        Route::patch('/{department}/move-down', [DepartmentController::class, 'moveDown'])->name('moveDown')->middleware('permission:departments.edit');
        Route::delete('/{department}', [DepartmentController::class, 'destroy'])->name('destroy')->middleware('permission:departments.delete');
    });

    Route::prefix('cms/departments-settings')->name('cms.departments.settings.')->middleware(['module:departments', 'permission:departments.edit'])->group(function () {
        Route::put('/', [DepartmentPageSettingController::class, 'update'])->name('update');
    });

    Route::prefix('cms/notices')->name('cms.notices.')->middleware('module:notices')->group(function () {
        Route::get('/', [NoticeController::class, 'index'])->name('index')->middleware('permission:notices.view');
        Route::get('/create', [NoticeController::class, 'create'])->name('create')->middleware('permission:notices.create');
        Route::get('/{notice}/edit', [NoticeController::class, 'edit'])->name('edit')->middleware('permission:notices.edit');
        Route::post('/', [NoticeController::class, 'store'])->name('store')->middleware('permission:notices.create');
        Route::put('/{notice}', [NoticeController::class, 'update'])->name('update')->middleware('permission:notices.edit');
        Route::patch('/{notice}/toggle', [NoticeController::class, 'toggleActive'])->name('toggle')->middleware('permission:notices.edit');
        Route::delete('/{notice}', [NoticeController::class, 'destroy'])->name('destroy')->middleware('permission:notices.delete');
    });

    Route::prefix('cms/notices-settings')->name('cms.notices.settings.')->middleware(['module:notices', 'permission:notices.edit'])->group(function () {
        Route::put('/', [NoticePageSettingController::class, 'update'])->name('update');
    });

    Route::prefix('cms/facilities')->name('cms.facilities.')->middleware('module:facilities')->group(function () {
        Route::get('/', [FacilityController::class, 'index'])->name('index')->middleware('permission:facilities.view');
        Route::get('/create', [FacilityController::class, 'create'])->name('create')->middleware('permission:facilities.create');
        Route::get('/{facility}/edit', [FacilityController::class, 'edit'])->name('edit')->middleware('permission:facilities.edit');
        Route::post('/', [FacilityController::class, 'store'])->name('store')->middleware('permission:facilities.create');
        Route::put('/{facility}', [FacilityController::class, 'update'])->name('update')->middleware('permission:facilities.edit');
        Route::patch('/{facility}/toggle', [FacilityController::class, 'toggleActive'])->name('toggle')->middleware('permission:facilities.edit');
        Route::patch('/{facility}/move-up', [FacilityController::class, 'moveUp'])->name('moveUp')->middleware('permission:facilities.edit');
        Route::patch('/{facility}/move-down', [FacilityController::class, 'moveDown'])->name('moveDown')->middleware('permission:facilities.edit');
        Route::delete('/{facility}', [FacilityController::class, 'destroy'])->name('destroy')->middleware('permission:facilities.delete');
    });

    Route::prefix('cms/facilities-settings')->name('cms.facilities.settings.')->middleware(['module:facilities', 'permission:facilities.edit'])->group(function () {
        Route::put('/', [FacilityPageSettingController::class, 'update'])->name('update');
    });

    Route::prefix('cms/portfolios')->name('cms.portfolios.')->middleware('module:portfolios')->group(function () {
        Route::get('/', [PortfolioController::class, 'index'])->name('index')->middleware('permission:portfolios.view');
        Route::get('/create', [PortfolioController::class, 'create'])->name('create')->middleware('permission:portfolios.create');
        Route::get('/{portfolio}/edit', [PortfolioController::class, 'edit'])->name('edit')->middleware('permission:portfolios.edit');
        Route::post('/', [PortfolioController::class, 'store'])->name('store')->middleware('permission:portfolios.create');
        Route::put('/{portfolio}', [PortfolioController::class, 'update'])->name('update')->middleware('permission:portfolios.edit');
        Route::patch('/{portfolio}/toggle', [PortfolioController::class, 'toggleActive'])->name('toggle')->middleware('permission:portfolios.edit');
        Route::patch('/{portfolio}/move-up', [PortfolioController::class, 'moveUp'])->name('moveUp')->middleware('permission:portfolios.edit');
        Route::patch('/{portfolio}/move-down', [PortfolioController::class, 'moveDown'])->name('moveDown')->middleware('permission:portfolios.edit');
        Route::delete('/{portfolio}', [PortfolioController::class, 'destroy'])->name('destroy')->middleware('permission:portfolios.delete');
    });

    Route::prefix('cms/portfolios-settings')->name('cms.portfolios.settings.')->middleware(['module:portfolios', 'permission:portfolios.edit'])->group(function () {
        Route::put('/', [PortfolioPageSettingController::class, 'update'])->name('update');
    });

    Route::prefix('cms/blog')->name('cms.blog.')->middleware('module:blog')->group(function () {
        Route::get('/', [BlogPostController::class, 'index'])->name('index')->middleware('permission:blog.view');
        Route::get('/create', [BlogPostController::class, 'create'])->name('create')->middleware('permission:blog.create');
        Route::get('/{blogPost}/edit', [BlogPostController::class, 'edit'])->name('edit')->middleware('permission:blog.edit');
        Route::post('/', [BlogPostController::class, 'store'])->name('store')->middleware('permission:blog.create');
        Route::put('/{blogPost}', [BlogPostController::class, 'update'])->name('update')->middleware('permission:blog.edit');
        Route::patch('/{blogPost}/toggle', [BlogPostController::class, 'toggleActive'])->name('toggle')->middleware('permission:blog.edit');
        Route::patch('/{blogPost}/move-up', [BlogPostController::class, 'moveUp'])->name('moveUp')->middleware('permission:blog.edit');
        Route::patch('/{blogPost}/move-down', [BlogPostController::class, 'moveDown'])->name('moveDown')->middleware('permission:blog.edit');
        Route::delete('/{blogPost}', [BlogPostController::class, 'destroy'])->name('destroy')->middleware('permission:blog.delete');
    });

    Route::prefix('cms/blog-settings')->name('cms.blog.settings.')->middleware(['module:blog', 'permission:blog.edit'])->group(function () {
        Route::put('/', [BlogPageSettingController::class, 'update'])->name('update');
    });

    Route::prefix('cms/testimonials')->name('cms.testimonials.')->middleware('module:testimonials')->group(function () {
        Route::get('/', [TestimonialController::class, 'index'])->name('index')->middleware('permission:testimonials.view');
        Route::post('/', [TestimonialController::class, 'store'])->name('store')->middleware('permission:testimonials.create');
        Route::put('/{testimonial}', [TestimonialController::class, 'update'])->name('update')->middleware('permission:testimonials.edit');
        Route::patch('/{testimonial}/toggle', [TestimonialController::class, 'toggleActive'])->name('toggle')->middleware('permission:testimonials.edit');
        Route::patch('/{testimonial}/move-up', [TestimonialController::class, 'moveUp'])->name('moveUp')->middleware('permission:testimonials.edit');
        Route::patch('/{testimonial}/move-down', [TestimonialController::class, 'moveDown'])->name('moveDown')->middleware('permission:testimonials.edit');
        Route::delete('/{testimonial}', [TestimonialController::class, 'destroy'])->name('destroy')->middleware('permission:testimonials.delete');
    });

    Route::prefix('cms/testimonials-settings')->name('cms.testimonials.settings.')->middleware(['module:testimonials', 'permission:testimonials.edit'])->group(function () {
        Route::put('/', [TestimonialPageSettingController::class, 'update'])->name('update');
    });

    Route::prefix('cms/faq')->name('cms.faq.')->middleware('module:faq')->group(function () {
        Route::get('/', [FaqController::class, 'index'])->name('index')->middleware('permission:faq.view');
        Route::post('/', [FaqController::class, 'store'])->name('store')->middleware('permission:faq.create');
        Route::put('/{faq}', [FaqController::class, 'update'])->name('update')->middleware('permission:faq.edit');
        Route::patch('/{faq}/toggle', [FaqController::class, 'toggleActive'])->name('toggle')->middleware('permission:faq.edit');
        Route::patch('/{faq}/move-up', [FaqController::class, 'moveUp'])->name('moveUp')->middleware('permission:faq.edit');
        Route::patch('/{faq}/move-down', [FaqController::class, 'moveDown'])->name('moveDown')->middleware('permission:faq.edit');
        Route::delete('/{faq}', [FaqController::class, 'destroy'])->name('destroy')->middleware('permission:faq.delete');
    });

    Route::prefix('cms/faq-settings')->name('cms.faq.settings.')->middleware(['module:faq', 'permission:faq.edit'])->group(function () {
        Route::put('/', [FaqPageSettingController::class, 'update'])->name('update');
    });

    Route::prefix('cms/founders-donors')->name('cms.founders-donors.')->middleware('module:founders_donors')->group(function () {
        Route::get('/', [FounderController::class, 'index'])->name('index')->middleware('permission:founders_donors.view');

        Route::prefix('founders')->name('founders.')->group(function () {
            Route::post('/', [FounderController::class, 'store'])->name('store')->middleware('permission:founders_donors.create');
            Route::put('/{founder}', [FounderController::class, 'update'])->name('update')->middleware('permission:founders_donors.edit');
            Route::patch('/{founder}/toggle', [FounderController::class, 'toggleActive'])->name('toggle')->middleware('permission:founders_donors.edit');
            Route::patch('/{founder}/move-up', [FounderController::class, 'moveUp'])->name('moveUp')->middleware('permission:founders_donors.edit');
            Route::patch('/{founder}/move-down', [FounderController::class, 'moveDown'])->name('moveDown')->middleware('permission:founders_donors.edit');
            Route::delete('/{founder}', [FounderController::class, 'destroy'])->name('destroy')->middleware('permission:founders_donors.delete');
        });

        Route::prefix('donors')->name('donors.')->group(function () {
            Route::post('/', [DonorController::class, 'store'])->name('store')->middleware('permission:founders_donors.create');
            Route::put('/{donor}', [DonorController::class, 'update'])->name('update')->middleware('permission:founders_donors.edit');
            Route::patch('/{donor}/toggle', [DonorController::class, 'toggleActive'])->name('toggle')->middleware('permission:founders_donors.edit');
            Route::patch('/{donor}/move-up', [DonorController::class, 'moveUp'])->name('moveUp')->middleware('permission:founders_donors.edit');
            Route::patch('/{donor}/move-down', [DonorController::class, 'moveDown'])->name('moveDown')->middleware('permission:founders_donors.edit');
            Route::delete('/{donor}', [DonorController::class, 'destroy'])->name('destroy')->middleware('permission:founders_donors.delete');
        });

        Route::prefix('settings')->name('settings.')->group(function () {
            Route::put('/', [FounderDonorPageSettingController::class, 'update'])->name('update')->middleware('permission:founders_donors.edit');
        });
    });

    Route::prefix('cms/class-schedules')->name('cms.class-schedules.')->group(function () {
        Route::get('/', [ClassScheduleController::class, 'index'])->name('index');
        Route::post('/', [ClassScheduleController::class, 'store'])->name('store');
        Route::put('/settings', [ClassScheduleController::class, 'updatePageSettings'])->name('settings.update');
        Route::put('/{classSchedule}', [ClassScheduleController::class, 'update'])->name('update');
        Route::patch('/{classSchedule}/toggle', [ClassScheduleController::class, 'toggleActive'])->name('toggle');
        Route::delete('/{classSchedule}', [ClassScheduleController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('cms/vision-mission')->name('cms.vision-mission.')->group(function () {
        Route::get('/', [VisionMissionPageSettingController::class, 'edit'])->name('edit');
        Route::put('/', [VisionMissionPageSettingController::class, 'update'])->name('update');
    });

    Route::prefix('cms/campus-tour')->name('cms.campus-tour.')->group(function () {
        Route::get('/', [CampusTourPageSettingController::class, 'edit'])->name('edit');
        Route::put('/', [CampusTourPageSettingController::class, 'update'])->name('update');
    });

    Route::prefix('cms/pages')->name('cms.pages.')->group(function () {
        Route::get('/', [PageController::class, 'index'])->name('index')->middleware('permission:pages.view');
        Route::get('/create', [PageController::class, 'create'])->name('create')->middleware('permission:pages.create');
        Route::get('/{page}/edit', [PageController::class, 'edit'])->name('edit')->middleware('permission:pages.edit');
        Route::post('/', [PageController::class, 'store'])->name('store')->middleware('permission:pages.create');
        Route::put('/{page}', [PageController::class, 'update'])->name('update')->middleware('permission:pages.edit');
        Route::patch('/{page}/toggle', [PageController::class, 'toggleActive'])->name('toggle')->middleware('permission:pages.edit');
        Route::delete('/{page}', [PageController::class, 'destroy'])->name('destroy')->middleware('permission:pages.delete');

        // Vvveb.js visual content builder bridge (see PageVisualBuilderController)
        // — a standalone full-screen editor, not an Inertia page. All of it
        // is gated under pages.edit — it's editing a page's content either way.
        Route::get('/builder/scan', [PageVisualBuilderController::class, 'scan'])->name('builder.scan')->middleware('permission:pages.edit');
        Route::get('/{page}/builder', [PageVisualBuilderController::class, 'edit'])->name('builder.edit')->middleware('permission:pages.edit');
        Route::get('/{page}/builder/content', [PageVisualBuilderController::class, 'content'])->name('builder.content')->middleware('permission:pages.edit');
        Route::post('/{page}/builder/save', [PageVisualBuilderController::class, 'save'])->name('builder.save')->middleware('permission:pages.edit');
        Route::post('/{page}/builder/upload', [PageVisualBuilderController::class, 'upload'])->name('builder.upload')->middleware('permission:pages.edit');
    });

    Route::prefix('cms/menus')->name('cms.menus.')->group(function () {
        Route::get('/', [MenuController::class, 'index'])->name('index')->middleware('permission:menus.view');
        Route::get('/linkables', [MenuController::class, 'searchLinkables'])->name('linkables')->middleware('permission:menus.view');
        Route::post('/items', [MenuController::class, 'storeItem'])->name('items.store')->middleware('permission:menus.create');
        Route::put('/items/{menuItem}', [MenuController::class, 'updateItem'])->name('items.update')->middleware('permission:menus.edit');
        Route::patch('/items/{menuItem}/toggle', [MenuController::class, 'toggleItem'])->name('items.toggle')->middleware('permission:menus.edit');
        Route::delete('/items/{menuItem}', [MenuController::class, 'destroyItem'])->name('items.destroy')->middleware('permission:menus.delete');
        Route::patch('/reorder', [MenuController::class, 'reorder'])->name('reorder')->middleware('permission:menus.edit');
    });

    Route::prefix('cms/contact-messages')->name('cms.contact-messages.')->middleware('module:contact')->group(function () {
        Route::get('/', [ContactMessageController::class, 'index'])->name('index')->middleware('permission:contact_messages.view');
        Route::patch('/{contactMessage}/read', [ContactMessageController::class, 'markRead'])->name('read')->middleware('permission:contact_messages.edit');
        Route::delete('/{contactMessage}', [ContactMessageController::class, 'destroy'])->name('destroy')->middleware('permission:contact_messages.delete');
    });

    // Modules below are navigable from the sidebar but not built out yet.
    // Each renders a placeholder page until its real controller/pages are
    // implemented — deliberately not permission-gated, there's no real
    // resource behind them yet for a permission to mean anything.
    $stubs = [
        // Temporarily hidden — not built out yet.
        // 'academic.classes' => ['classes', 'Classes'],
        // 'academic.sections' => ['sections', 'Sections'],
        // 'academic.subjects' => ['subjects', 'Subjects'],
        // 'academic.routine' => ['routine', 'Class Routine'],
        // 'academic.exams' => ['exams', 'Exams'],
        // 'academic.results' => ['results', 'Results'],
        // 'academic.attendance' => ['attendance', 'Attendance'],

        
        
        'coming.soon' => ['coming-soon', 'Coming Soon'],

        // 'people.students' => ['students', 'Students'],
        // 'people.teachers' => ['teachers', 'Teachers'],
        // 'people.staff' => ['staff', 'Staff'],
        // 'people.parents' => ['parents', 'Parents'],
        // 'people.admissions' => ['admissions', 'Admissions'],

        'cms.downloads' => ['cms/downloads', 'Downloads'],

        // Temporarily hidden — not built out yet.
        // 'finance.fees' => ['finance/fees', 'Fee Structure'],
        // 'finance.invoices' => ['finance/invoices', 'Invoices'],
        // 'finance.payments' => ['finance/payments', 'Payments'],
        // 'finance.expenses' => ['finance/expenses', 'Expenses'],

        // 'hr.payroll' => ['hr/payroll', 'Payroll'],
        // 'hr.leave' => ['hr/leave', 'Leave Requests'],

        // 'communication.messages' => ['communication/messages', 'Contact Messages'],
        // 'communication.announcements' => ['communication/announcements', 'Announcements'],

        'settings.general' => ['settings/general', 'General Settings'],
    ];

    foreach ($stubs as $name => [$uri, $title]) {
        Route::get("/{$uri}", fn () => Inertia::render('Admin/ComingSoon', ['title' => $title]))->name($name);
    }

    Route::prefix('exam-startup')->name('exam-startup.')->group(function () {
        Route::get('/', [\Modules\Exam\Http\Controllers\Admin\ExamStartupController::class, 'index'])->name('index');
        Route::post('/codes', [\Modules\Exam\Http\Controllers\Admin\ExamStartupController::class, 'storeCodes'])->name('storeCodes');
        Route::post('/grades', [\Modules\Exam\Http\Controllers\Admin\ExamStartupController::class, 'storeGrades'])->name('storeGrades');
        Route::post('/exams', [\Modules\Exam\Http\Controllers\Admin\ExamStartupController::class, 'storeExams'])->name('storeExams');
    });

    Route::resource('exam-marks', \Modules\Exam\Http\Controllers\Admin\ExamMarkController::class)->except(['create', 'show', 'edit']);
    Route::resource('exam-remarks', \Modules\Exam\Http\Controllers\Admin\ExamRemarkController::class)->except(['create', 'show', 'edit']);

    Route::prefix('mark-input')->name('mark-input.')->group(function () {
        Route::get('/', [\Modules\Exam\Http\Controllers\Admin\MarkInputController::class, 'index'])->name('index');
        Route::get('/{classId}', [\Modules\Exam\Http\Controllers\Admin\MarkInputController::class, 'show'])->name('show');
        Route::post('/fetch-students', [\Modules\Exam\Http\Controllers\Admin\MarkInputController::class, 'fetchStudents'])->name('fetchStudents');
        Route::post('/store', [\Modules\Exam\Http\Controllers\Admin\MarkInputController::class, 'store'])->name('store');
    });



    // Class Routine
    Route::prefix('class-routine')->name('class-routine.')->group(function () {
        Route::get('/', [\Modules\Academic\Http\Controllers\Admin\ClassRoutineController::class, 'index'])->name('index');
        Route::get('/manage/{classId}/{sectionId?}', [\Modules\Academic\Http\Controllers\Admin\ClassRoutineController::class, 'manage'])->name('manage');
        Route::post('/store', [\Modules\Academic\Http\Controllers\Admin\ClassRoutineController::class, 'store'])->name('store');
    });

    Route::prefix('exam-result')->name('exam-result.')->group(function () {
        Route::get('/', [\Modules\Exam\Http\Controllers\Admin\ExamResultController::class, 'index'])->name('index');
        Route::post('/fetch-results', [\Modules\Exam\Http\Controllers\Admin\ExamResultController::class, 'fetchResults'])->name('fetchResults');
    });

    Route::prefix('grand-final-result')->name('grand-final-result.')->group(function () {
        Route::get('/', [\Modules\Exam\Http\Controllers\Admin\GrandFinalResultController::class, 'index'])->name('index');
        Route::post('/fetch-results', [\Modules\Exam\Http\Controllers\Admin\GrandFinalResultController::class, 'fetchResults'])->name('fetchResults');
    });
});
