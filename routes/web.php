<?php

use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CampusTourController;
use App\Http\Controllers\ClassScheduleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FounderDonorController;
use App\Http\Controllers\GalleryImageController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\VisionMissionController;
use App\Models\BlogPageSetting;
use App\Models\BlogPost;
use App\Models\Course;
use App\Models\CoursePageSetting;
use App\Models\Department;
use App\Models\DepartmentPageSetting;
use App\Models\Event;
use App\Models\EventPageSetting;
use App\Models\GalleryImage;
use App\Models\GalleryPageSetting;
use App\Models\Notice;
use App\Models\NoticePageSetting;
use App\Models\Slider;
use App\Models\Teacher;
use App\Models\TeacherPageSetting;
use App\Models\Testimonial;
use App\Models\TestimonialPageSetting;
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
        'blogPosts' => BlogPost::forHomepage(),
        'blogPageSettings' => BlogPageSetting::current(),
        'testimonials' => Testimonial::forHomepage(),
        'testimonialPageSettings' => TestimonialPageSetting::current(),
        'sidebarNotices' => Notice::forMarquee(5),
    ]);
})->name('home');

Route::middleware('module:about')->get('/about', function () {
    return view('frontend.about', [
        'teachers' => Teacher::forHomepage(),
        'teacherPageSettings' => TeacherPageSetting::current(),
        'testimonials' => Testimonial::forHomepage(),
        'testimonialPageSettings' => TestimonialPageSetting::current(),
    ]);
})->name('about');

Route::middleware('module:contact')->group(function () {
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
});

Route::middleware('module:principal')->get('/principal', function () {
    return view('frontend.principal');
})->name('principal');

Route::get('/class-schedule', [ClassScheduleController::class, 'index'])->name('class-schedule');
Route::get('/mission-vision', [VisionMissionController::class, 'index'])->name('mission-vision');
Route::get('/campus-tour', [CampusTourController::class, 'index'])->name('campus-tour');

Route::middleware('module:ex_principal')->get('/ex-principals', function () {
    return view('frontend.ex-principal');
})->name('ex-principal');

Route::middleware('module:courses')->group(function () {
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/{course:slug}', [CourseController::class, 'show'])->name('courses.show');
});

Route::middleware('module:teachers')->group(function () {
    Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::get('/teachers/{teacher:slug}', [TeacherController::class, 'show'])->name('teachers.show');
});

Route::middleware('module:gallery')->get('/gallery', [GalleryImageController::class, 'index'])->name('gallery.index');

Route::middleware('module:events')->group(function () {
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/{event:slug}', [EventController::class, 'show'])->name('events.show');
});

Route::middleware('module:departments')->group(function () {
    Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
    Route::get('/departments/{department:slug}', [DepartmentController::class, 'show'])->name('departments.show');
});

Route::middleware('module:notices')->group(function () {
    Route::get('/notices', [NoticeController::class, 'index'])->name('notices.index');
    Route::get('/notices/{notice:slug}', [NoticeController::class, 'show'])->name('notices.show');
});

Route::middleware('module:facilities')->group(function () {
    Route::get('/facilities', [FacilityController::class, 'index'])->name('facilities.index');
    Route::get('/facilities/{facility:slug}', [FacilityController::class, 'show'])->name('facilities.show');
});

Route::middleware('module:portfolios')->group(function () {
    Route::get('/portfolios', [PortfolioController::class, 'index'])->name('portfolios.index');
    Route::get('/portfolios/{portfolio:slug}', [PortfolioController::class, 'show'])->name('portfolios.show');
});

Route::middleware('module:blog')->group(function () {
    Route::get('/blog', [BlogPostController::class, 'index'])->name('blog.index');
    Route::get('/blog/{post:slug}', [BlogPostController::class, 'show'])->name('blog.show');
});

Route::middleware('module:testimonials')->get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');

Route::middleware('module:faq')->get('/faq', [FaqController::class, 'index'])->name('faq.index');

Route::middleware('module:founders_donors')->get('/founders-donors', [FounderDonorController::class, 'index'])->name('founders-donors.index');

Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::get('/language/{code}', [LocaleController::class, 'update'])->name('language.switch');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->hasRole('teacher')) {
            return redirect()->route('teacher.dashboard');
        }
        if ($user->hasAnyRole(['admin', 'system_admin'])) {
            return redirect()->route('admin.dashboard');
        }
        if ($user->hasRole('student')) {
            return redirect()->route('student.dashboard');
        }
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

require __DIR__.'/admin.php';

// Catch-all for admin-built Pages — must stay the LAST route registered in
// the whole file so it never shadows a more specific route above (Laravel
// resolves ambiguous single-segment matches by registration order). Admin
// routes are all under the multi-segment '/admin/...' prefix so they can't
// collide with this single-segment pattern regardless of order, but
// '/dashboard' above is single-segment and must be registered first.
Route::get('/{page:slug}', [PageController::class, 'show'])->name('pages.show');
