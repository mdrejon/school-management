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
use App\Http\Controllers\StaffController;
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
use App\Http\Controllers\Frontend\StudentController;
use App\Http\Controllers\Frontend\TuitionFeeController;
use App\Http\Controllers\Frontend\ResultController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/clear-cache', function () {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
    return "All caches cleared successfully!";
});

Route::get('admin/optimize', function () {
    $results = [];

    $commands = [
        // ── Clear everything first ──────────────────────────
        'cache:clear'       => 'Clear Application Cache',
        'config:clear'      => 'Clear Config Cache',
        'route:clear'       => 'Clear Route Cache',
        'view:clear'        => 'Clear View Cache',
        'event:clear'       => 'Clear Event Cache',
        'optimize:clear'    => 'Clear All Optimizations',

        // ── Rebuild optimized cache ─────────────────────────
        'config:cache'      => 'Cache Config',
        'route:cache'       => 'Cache Routes',
        'view:cache'        => 'Cache Views',
        'event:cache'       => 'Cache Events',
        'optimize'          => 'Run Full Optimize',
    ];

    foreach ($commands as $command => $label) {
        try {
            \Illuminate\Support\Facades\Artisan::call($command);
            $output = trim(\Illuminate\Support\Facades\Artisan::output());
            $results[] = [
                'command' => $command,
                'label'   => $label,
                'status'  => 'success',
                'output'  => $output ?: 'Done',
            ];
        } catch (\Throwable $e) {
            $results[] = [
                'command' => $command,
                'label'   => $label,
                'status'  => 'error',
                'output'  => $e->getMessage(),
            ];
        }
    }

    // ── Return a clean HTML report ──────────────────────────
    $html = '<html><head><meta charset="utf-8">
    <title>Server Optimize</title>
    <style>
        body { font-family: monospace; background: #0f172a; color: #e2e8f0; padding: 30px; }
        h1   { color: #38bdf8; font-size: 22px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th   { background: #1e293b; color: #94a3b8; text-align: left; padding: 10px 14px; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; }
        td   { padding: 10px 14px; border-bottom: 1px solid #1e293b; font-size: 13px; }
        tr:hover td { background: #1e293b; }
        .badge-ok  { background: #14532d; color: #86efac; padding: 2px 10px; border-radius: 99px; font-size: 11px; }
        .badge-err { background: #7f1d1d; color: #fca5a5; padding: 2px 10px; border-radius: 99px; font-size: 11px; }
        .cmd  { color: #f59e0b; }
        .out  { color: #94a3b8; font-size: 11px; }
        .footer { margin-top: 20px; color: #475569; font-size: 12px; }
    </style></head><body>';

    $html .= '<h1>🚀 Server Optimization Report</h1>';
    $html .= '<p style="color:#64748b;margin-bottom:20px;">Run at: ' . now()->format('Y-m-d H:i:s') . ' (Server Time)</p>';
    $html .= '<table><tr><th>#</th><th>Label</th><th>Command</th><th>Status</th><th>Output</th></tr>';

    foreach ($results as $i => $r) {
        $badge = $r['status'] === 'success'
            ? '<span class="badge-ok">✓ OK</span>'
            : '<span class="badge-err">✗ Error</span>';

        $html .= "<tr>
            <td>" . ($i + 1) . "</td>
            <td>{$r['label']}</td>
            <td class='cmd'>php artisan {$r['command']}</td>
            <td>{$badge}</td>
            <td class='out'>" . htmlspecialchars($r['output']) . "</td>
        </tr>";
    }

    $successCount = count(array_filter($results, fn($r) => $r['status'] === 'success'));
    $errorCount   = count($results) - $successCount;

    $html .= '</table>';
    $html .= "<div class='footer'>✅ {$successCount} succeeded &nbsp;|&nbsp; ❌ {$errorCount} failed &nbsp;|&nbsp; Total: " . count($results) . " commands</div>";
    $html .= '</body></html>';

    return $html;
});

Route::get('/storage-link', function () {
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    return "Storage link created successfully!";
});
// Route::get('/assign-super-admin', function () {
//     $user = \App\Models\User::where('email', 'admin@admin.com')->first();
//     if ($user) {
//         $role = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'system_admin', 'guard_name' => 'web']);
//         $user->assignRole($role);
//         return "system_admin role assigned successfully to admin@admin.com!";
//     }
//     return "User admin@admin.com not found";
// });

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

Route::get('/chairman-message', function () {
    return view('frontend.chairman');
})->name('chairman-message');

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

Route::get('/academic-calendar', [\App\Http\Controllers\Frontend\AcademicCalendarController::class, 'index'])->name('academic-calendar.index');
Route::get('/api/academic-calendar/events', [\App\Http\Controllers\Frontend\AcademicCalendarController::class, 'events'])->name('api.academic-calendar.events');

require __DIR__ . '/admin.php';

Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/tuition-fees', [TuitionFeeController::class, 'index'])->name('tuition-fees');

// Result Pages
Route::get('/results', [ResultController::class, 'exam'])->name('results');
Route::get('/academic-results', [ResultController::class, 'academic'])->name('academic-results');
Route::get('/evaluation-results', [ResultController::class, 'evaluation'])->name('evaluation-results');
Route::get('/board-exam-results', [ResultController::class, 'boardExam'])->name('board-exam-results');

Route::get('/staff-information', [StaffController::class, 'index'])->name('staff.index');
Route::get('/staff-information/{staff}', [StaffController::class, 'show'])->name('staff.show');

Route::get('/education-levels', [\App\Http\Controllers\Frontend\EducationLevelController::class, 'index'])->name('education-levels.index');

Route::get('/syllabus', [\App\Http\Controllers\Frontend\SyllabusController::class, 'index'])->name('syllabus.index');
Route::get('/syllabus/{id}/download', [\App\Http\Controllers\Frontend\SyllabusController::class, 'download'])->name('syllabus.download');

Route::get('/class-routine', [\App\Http\Controllers\Frontend\ClassRoutineController::class, 'index'])->name('class-routine.index');

// Catch-all for admin-built Pages — must stay the LAST route registered in
// the whole file so it never shadows a more specific route above (Laravel
// resolves ambiguous single-segment matches by registration order). Admin
// routes are all under the multi-segment '/admin/...' prefix so they can't
// collide with this single-segment pattern regardless of order, but
// '/dashboard' above is single-segment and must be registered first.
Route::get('/{page:slug}', [PageController::class, 'show'])->name('pages.show');
