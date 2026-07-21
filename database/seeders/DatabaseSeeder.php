<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
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

        $this->call(LanguageSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(SiteSettingSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(TeacherSeeder::class);
        $this->call(GalleryImageSeeder::class);
        $this->call(EventSeeder::class);
        $this->call(DepartmentSeeder::class);
    }
}
