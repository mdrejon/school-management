<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Course;
use App\Models\Department;
use App\Models\Event;
use App\Models\Facility;
use App\Models\Faq;
use App\Models\Founder;
use App\Models\GalleryImage;
use App\Models\Language;
use App\Models\Menu;
use App\Models\Notice;
use App\Models\Page;
use App\Models\Portfolio;
use App\Models\SiteSetting;
use App\Models\Slider;
use App\Models\Teacher;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     *
     * Every demo-data seeder below is guarded on its table being empty —
     * these are first-run sample content, not config to keep re-syncing.
     * Re-running `db:seed` on a database that already has real admin-
     * entered content must never touch it: several seeders `updateOrCreate`
     * by slug (Course, Teacher, Event, Department, Notice, Facility,
     * Portfolio, BlogPost) or overwrite the single settings row wholesale
     * (SiteSetting, and every `{Thing}PageSetting` seeded alongside its
     * content type) — without this guard, a second `db:seed` run would
     * silently revert any edits made through the admin panel back to the
     * placeholder seed text. Delete a specific table's rows yourself first
     * if you actually want that one reseeded.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        if (! User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        $this->seedIfEmpty(Language::class, LanguageSeeder::class);
        $this->seedIfEmpty(Slider::class, SliderSeeder::class);
        $this->seedIfEmpty(SiteSetting::class, SiteSettingSeeder::class);
        $this->seedIfEmpty(Course::class, CourseSeeder::class);
        $this->seedIfEmpty(Teacher::class, TeacherSeeder::class);
        $this->seedIfEmpty(GalleryImage::class, GalleryImageSeeder::class);
        $this->seedIfEmpty(Event::class, EventSeeder::class);
        $this->seedIfEmpty(Department::class, DepartmentSeeder::class);
        $this->seedIfEmpty(Notice::class, NoticeSeeder::class);
        $this->seedIfEmpty(Menu::class, MenuSeeder::class);
        $this->seedIfEmpty(Page::class, PageSeeder::class);
        $this->seedIfEmpty(Facility::class, FacilitySeeder::class);
        $this->seedIfEmpty(Portfolio::class, PortfolioSeeder::class);
        $this->seedIfEmpty(BlogPost::class, BlogPostSeeder::class);
        $this->seedIfEmpty(Testimonial::class, TestimonialSeeder::class);
        $this->seedIfEmpty(Faq::class, FaqSeeder::class);
        $this->seedIfEmpty(Founder::class, FounderDonorSeeder::class);
        $this->seedIfEmpty(Role::class, RoleAndPermissionSeeder::class);
    }

    /**
     * Run a seeder only if its table has no rows yet. Named to avoid
     * colliding with the base Seeder::callOnce() (a different, public
     * per-run-dedup mechanism Laravel itself defines).
     *
     * @param  class-string<\Illuminate\Database\Eloquent\Model>  $model
     * @param  class-string<\Illuminate\Database\Seeder>  $seeder
     */
    protected function seedIfEmpty(string $model, string $seeder): void
    {
        if ($model::count() === 0) {
            $this->call($seeder);
        }
    }
}
