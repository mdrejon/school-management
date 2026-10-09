<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CoursePageSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedPageSettings();
        $this->seedCourses();
    }

    protected function seedPageSettings(): void
    {
        $breadcrumbImage = $this->copyIntoStorage('breadcrumb/01.jpg', 'site/courses-breadcrumb.jpg');
        $settings = CoursePageSetting::query()->first() ?? new CoursePageSetting();

        $settings->fill([
            'section_tagline' => ['en' => 'Our Courses', 'bn' => 'আমাদের কোর্স', 'ar' => 'دوراتنا'],
            'section_title' => [
                'en' => "Let's Check Our Courses",
                'bn' => 'আমাদের কোর্সগুলো দেখুন',
                'ar' => 'تحقق من دوراتنا',
            ],
            'section_highlight' => ['en' => 'Courses', 'bn' => 'কোর্স', 'ar' => 'دورات'],
            'section_description' => [
                'en' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
                'bn' => 'এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।',
                'ar' => 'من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.',
            ],
            'breadcrumb_title' => ['en' => 'Our Courses', 'bn' => 'আমাদের কোর্স', 'ar' => 'دوراتنا'],
            'breadcrumb_image' => $breadcrumbImage ?? $settings->breadcrumb_image,
            'seo_title' => [
                'en' => 'Our Courses',
                'bn' => 'আমাদের কোর্স',
                'ar' => 'دوراتنا',
            ],
            'seo_description' => [
                'en' => 'Browse the courses offered by our school — duration, fees, seats, and requirements for each program.',
                'bn' => 'আমাদের স্কুলের কোর্সসমূহ ব্রাউজ করুন — সময়কাল, ফি, আসন এবং প্রতিটি প্রোগ্রামের প্রয়োজনীয়তা।',
                'ar' => 'تصفح الدورات التي تقدمها مدرستنا - المدة والرسوم والمقاعد ومتطلبات كل برنامج.',
            ],
            'seo_keywords' => [
                'en' => 'courses, admission, school courses',
                'bn' => 'কোর্স, ভর্তি, স্কুল কোর্স',
                'ar' => 'دورات، القبول، دورات المدرسة',
            ],
        ])->save();
    }

        protected function seedCourses(): void
    {
        require_once base_path('scratch_courses.php');

        $teacherImage = $this->copyIntoStorage('course/teacher.jpg', 'site/courses-instructor.jpg');
        $galleryImage1 = $this->copyIntoStorage('course/01.jpg', 'site/courses-gallery-1.jpg');
        $galleryImage2 = $this->copyIntoStorage('course/02.jpg', 'site/courses-gallery-2.jpg');

        \App\Models\Course::query()->delete();

        foreach ($courses as $index => $course) {
            $thumbnail = $this->copyIntoStorage($course['thumbnail'], "site/courses/{$course['slug']}.jpg");

            \App\Models\Course::updateOrCreate(
                ['slug' => $course['slug']],
                [
                    'title' => $course['title'],
                    'category' => $course['category'],
                    'thumbnail' => $thumbnail,
                    'short_description' => $course['short_description'],
                    'lessons_count' => $course['lessons_count'],
                    'rating' => $course['rating'],
                    'seats' => $course['seats'],
                    'duration' => $course['duration'],
                    'price' => $course['price'],
                    'description' => $course['description'],
                    'gallery_image_1' => $galleryImage1,
                    'gallery_image_2' => $galleryImage2,
                    'instructor_name' => $course['instructor'],
                    'instructor_image' => $teacherImage,
                    'enrolled_text' => $course['enrolled'],
                    'requirement_title' => $course['requirement_title'],
                    'requirement_items' => collect($course['requirement_items'])->map(fn ($text) => ['text' => $text])->all(),
                    'experience_title' => $course['experience_title'],
                    'experience_description' => $course['experience_description'],
                    'features' => collect($course['features'])->map(fn ($feature) => [
                        'icon' => ['source' => 'lucide', 'value' => $feature['icon']],
                        'label' => $feature['label'],
                        'value' => is_array($feature['value']) ? $feature['value'] : ['en' => $feature['value'], 'bn' => $feature['value'], 'ar' => $feature['value']],
                    ])->all(),
                    'is_active' => true,
                    'sort_order' => $index + 1,
                ],
            );
        }
    }

    protected function copyIntoStorage(string $source, string $destination): ?string
    {
        $sourcePath = public_path("frontend/assets/img/{$source}");

        if (! is_file($sourcePath)) {
            return null;
        }

        if (! Storage::disk('public')->exists($destination)) {
            Storage::disk('public')->put($destination, file_get_contents($sourcePath));
        }

        return $destination;
    }
}
