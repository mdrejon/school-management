<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use App\Models\TestimonialPageSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Testimonial::truncate();
        TestimonialPageSetting::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->seedPageSettings();
        $this->seedTestimonials();
    }

    protected function seedPageSettings(): void
    {
        $breadcrumbImage = $this->copyIntoStorage('breadcrumb/01.jpg', 'site/testimonials-breadcrumb.jpg');
        $settings = new TestimonialPageSetting();

        $settings->fill([
            'section_tagline' => ['en' => 'Testimonials', 'bn' => 'প্রশংসাপত্র'],
            'section_title' => ["en" => "What Our Students & Parents Say", 'bn' => 'আমাদের শিক্ষার্থী ও অভিভাবকরা যা বলেন'],
            'section_highlight' => ["en" => "Say", 'bn' => 'বলেন'],
            'section_description' => [
                'en' => 'Discover why students and parents love EduEx School and College.',
                'bn' => 'শিক্ষার্থী ও অভিভাবকরা কেন এডুএক্স স্কুল এন্ড কলেজ পছন্দ করেন তা জানুন।',
            ],
            'breadcrumb_title' => ['en' => 'Testimonials', 'bn' => 'প্রশংসাপত্র'],
            'breadcrumb_image' => $breadcrumbImage ?? null,
            'seo_title' => ['en' => 'Testimonials | EduEx School and College', 'bn' => 'প্রশংসাপত্র | এডুএক্স স্কুল এন্ড কলেজ'],
            'seo_description' => [
                'en' => 'Read reviews and testimonials from our students and parents.',
                'bn' => 'আমাদের শিক্ষার্থী ও অভিভাবকদের থেকে পর্যালোচনা এবং প্রশংসাপত্র পড়ুন।',
            ],
            'seo_keywords' => [
                'en' => 'testimonials, reviews, student feedback, eduex reviews',
                'bn' => 'প্রশংসাপত্র, পর্যালোচনা, শিক্ষার্থীর মতামত, এডুএক্স রিভিউ',
            ],
        ])->save();
    }

    protected function seedTestimonials(): void
    {
        $testimonials = [
            [
                'name' => ['en' => 'Sarah Rahman', 'bn' => 'সারা রহমান'], 
                'role' => ['en' => 'Former Student (HSC Batch 2024)', 'bn' => 'প্রাক্তন শিক্ষার্থী (এইচএসসি ব্যাচ ২০২৪)'], 
                'image' => 'testimonial/01.jpg',
                'rating' => 5,
                'quote' => [
                    'en' => 'EduEx School and College gave me the foundation I needed to excel in university. The teachers were incredibly supportive!',
                    'bn' => 'বিশ্ববিদ্যালয়ে ভালো করার জন্য যে ভিত্তি প্রয়োজন ছিল তা এডুএক্স স্কুল এন্ড কলেজ আমাকে দিয়েছে। শিক্ষকরা অবিশ্বাস্যভাবে সহায়ক ছিলেন!'
                ]
            ],
            [
                'name' => ['en' => 'Ahsan Habib', 'bn' => 'আহসান হাবিব'], 
                'role' => ['en' => 'Parent of Class 8 Student', 'bn' => 'অষ্টম শ্রেণির শিক্ষার্থীর অভিভাবক'], 
                'image' => 'testimonial/02.jpg',
                'rating' => 5,
                'quote' => [
                    'en' => 'Since enrolling my son at EduEx, I have seen a remarkable improvement in his confidence and academic performance.',
                    'bn' => 'আমার ছেলেকে এডুএক্সে ভর্তি করার পর থেকে তার আত্মবিশ্বাস এবং একাডেমিক পারফরম্যান্সে আমি উল্লেখযোগ্য উন্নতি দেখেছি।'
                ]
            ],
            [
                'name' => ['en' => 'Rafiqul Islam', 'bn' => 'রফিকুল ইসলাম'], 
                'role' => ['en' => 'Alumni & Entrepreneur', 'bn' => 'প্রাক্তন ছাত্র ও উদ্যোক্তা'], 
                'image' => 'testimonial/03.jpg',
                'rating' => 5,
                'quote' => [
                    'en' => 'The focus on both academics and extracurriculars at EduEx helped shape my career. I am proud to be an alumni.',
                    'bn' => 'এডুএক্সে পড়াশোনার পাশাপাশি পাঠ্যক্রম বহির্ভূত কার্যক্রমের প্রতি মনোযোগ আমার ক্যারিয়ার গড়তে সাহায্য করেছে। আমি একজন প্রাক্তন ছাত্র হিসেবে গর্বিত।'
                ]
            ],
        ];

        foreach ($testimonials as $index => $testimonial) {
            $image = $this->copyIntoStorage($testimonial['image'], "site/testimonial-" . ($index + 1) . ".jpg");

            Testimonial::create([
                'author_name' => $testimonial['name'],
                'author_role' => $testimonial['role'],
                'quote' => $testimonial['quote'],
                'rating' => $testimonial['rating'],
                'author_photo' => $image,
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
