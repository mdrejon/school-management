<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use App\Models\TestimonialPageSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedPageSettings();
        $this->seedTestimonials();
    }

    protected function seedPageSettings(): void
    {
        $breadcrumbImage = $this->copyIntoStorage('breadcrumb/01.jpg', 'site/testimonials-breadcrumb.jpg');
        $settings = TestimonialPageSetting::query()->first() ?? new TestimonialPageSetting();

        $settings->fill([
            'section_tagline' => ['en' => 'Testimonials', 'bn' => 'প্রশংসাপত্র', 'ar' => 'الشهادات'],
            'section_title' => ["en" => "What Our Students Say's", 'bn' => 'আমাদের শিক্ষার্থীরা যা বলে', 'ar' => 'ماذا يقول طلابنا'],
            'section_highlight' => ["en" => "Say's", 'bn' => 'বলে', 'ar' => 'يقول'],
            'section_description' => [
                'en' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
                'bn' => 'এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।',
                'ar' => 'من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.',
            ],
            'breadcrumb_title' => ['en' => 'Testimonials', 'bn' => 'প্রশংসাপত্র', 'ar' => 'الشهادات'],
            'breadcrumb_image' => $breadcrumbImage ?? $settings->breadcrumb_image,
            'seo_title' => ['en' => 'Testimonials', 'bn' => 'প্রশংসাপত্র', 'ar' => 'الشهادات'],
            'seo_description' => [
                'en' => 'See what our students and parents say about our school.',
                'bn' => 'আমাদের শিক্ষার্থী ও অভিভাবকরা আমাদের স্কুল সম্পর্কে কী বলেন তা দেখুন।',
                'ar' => 'اطلع على آراء طلابنا وأولياء الأمور حول مدرستنا.',
            ],
            'seo_keywords' => [
                'en' => 'testimonials, reviews, student feedback',
                'bn' => 'প্রশংসাপত্র, পর্যালোচনা, শিক্ষার্থীর মতামত',
                'ar' => 'شهادات، تقييمات، آراء الطلاب',
            ],
        ])->save();
    }

    protected function seedTestimonials(): void
    {
        $quote = [
            'en' => 'There are many variations of tend to repeat chunks some all form necessary injected for the going are humour words.',
            'bn' => 'আমার সন্তান এই স্কুলে ভর্তি হওয়ার পর থেকে অনেক উন্নতি করেছে। শিক্ষকরা অত্যন্ত যত্নশীল ও পেশাদার।',
            'ar' => 'لقد تحسن طفلي كثيرًا منذ التحاقه بهذه المدرسة. المعلمون مهتمون ومحترفون للغاية.',
        ];

        $testimonials = [
            ['name' => ['en' => 'Anthony Nicoll', 'bn' => 'অ্যান্থনি নিকোল', 'ar' => 'أنتوني نيكول'], 'role' => ['en' => 'Student', 'bn' => 'শিক্ষার্থী', 'ar' => 'طالب'], 'image' => 'testimonial/01.jpg'],
            ['name' => ['en' => 'Richard Lock', 'bn' => 'রিচার্ড লক', 'ar' => 'ريتشارد لوك'], 'role' => ['en' => 'Student', 'bn' => 'শিক্ষার্থী', 'ar' => 'طالب'], 'image' => 'testimonial/02.jpg'],
            ['name' => ['en' => 'Randal Grand', 'bn' => 'র‍্যান্ডাল গ্র্যান্ড', 'ar' => 'راندال جراند'], 'role' => ['en' => 'Parent', 'bn' => 'অভিভাবক', 'ar' => 'ولي أمر'], 'image' => 'testimonial/03.jpg'],
            ['name' => ['en' => 'Edward Miles', 'bn' => 'এডওয়ার্ড মাইলস', 'ar' => 'إدوارد مايلز'], 'role' => ['en' => 'Student', 'bn' => 'শিক্ষার্থী', 'ar' => 'طالب'], 'image' => 'testimonial/04.jpg'],
            ['name' => ['en' => 'Ninal Gordon', 'bn' => 'নিনাল গর্ডন', 'ar' => 'نينال غوردون'], 'role' => ['en' => 'Parent', 'bn' => 'অভিভাবক', 'ar' => 'ولي أمر'], 'image' => 'testimonial/05.jpg'],
        ];

        foreach ($testimonials as $index => $testimonial) {
            $photo = $this->copyIntoStorage($testimonial['image'], "site/testimonials/".($index + 1).".jpg");

            $existing = Testimonial::whereJsonContains('author_name->en', $testimonial['name']['en'])->first();

            if ($existing) {
                continue;
            }

            Testimonial::create([
                'quote' => $quote,
                'rating' => 5,
                'author_name' => $testimonial['name'],
                'author_role' => $testimonial['role'],
                'author_photo' => $photo,
                'is_active' => true,
                'sort_order' => $index + 1,
            ]);
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
