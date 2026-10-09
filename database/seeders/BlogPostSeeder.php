<?php

namespace Database\Seeders;

use App\Models\BlogPageSetting;
use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        // Truncate tables to remove old madrasa data
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        BlogPost::truncate();
        BlogPageSetting::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->seedPageSettings();
        $this->seedPosts();
    }

    protected function seedPageSettings(): void
    {
        $breadcrumbImage = $this->copyIntoStorage('breadcrumb/01.jpg', 'site/blog-breadcrumb.jpg');
        $settings = new BlogPageSetting();

        $settings->fill([
            'section_tagline' => ['en' => 'Our Blog', 'bn' => 'আমাদের ব্লগ'],
            'section_title' => ['en' => 'Latest News & Articles', 'bn' => 'সর্বশেষ সংবাদ ও নিবন্ধ'],
            'section_highlight' => ['en' => 'Articles', 'bn' => 'নিবন্ধ'],
            'section_description' => [
                'en' => 'Discover the latest updates, achievements, and educational articles from EduEx School and College.',
                'bn' => 'এডুএক্স স্কুল এন্ড কলেজের সর্বশেষ আপডেট, অর্জন এবং শিক্ষামূলক নিবন্ধগুলো সম্পর্কে জানুন।',
            ],
            'breadcrumb_title' => ['en' => 'Our Blog', 'bn' => 'আমাদের ব্লগ'],
            'breadcrumb_image' => $breadcrumbImage ?? null,
            'seo_title' => ['en' => 'Blog | EduEx School and College', 'bn' => 'ব্লগ | এডুএক্স স্কুল এন্ড কলেজ'],
            'seo_description' => [
                'en' => 'Read the latest news, updates, and educational articles from EduEx School and College.',
                'bn' => 'এডুএক্স স্কুল এন্ড কলেজের সর্বশেষ সংবাদ, আপডেট এবং শিক্ষামূলক নিবন্ধ পড়ুন।',
            ],
            'seo_keywords' => [
                'en' => 'school blog, college news, education articles, EduEx updates',
                'bn' => 'স্কুল ব্লগ, কলেজের খবর, শিক্ষামূলক নিবন্ধ, এডুএক্স আপডেট',
            ],
        ])->save();
    }

    protected function seedPosts(): void
    {
        $tagSet = [
            ['en' => 'Education', 'bn' => 'শিক্ষা'],
            ['en' => 'Events', 'bn' => 'ইভেন্ট'],
            ['en' => 'Achievements', 'bn' => 'অর্জন'],
        ];

        $posts = [
            [
                'slug' => 'importance-of-extracurricular-activities',
                'title' => [
                    'en' => 'The Importance of Extracurricular Activities in School', 
                    'bn' => 'স্কুলে পাঠ্যক্রম বহির্ভূত কার্যক্রমের গুরুত্ব'
                ],
                'image' => 'blog/01.jpg',
                'days_ago' => 5,
                'author' => ['en' => 'Principal', 'bn' => 'অধ্যক্ষ'],
                'short' => [
                    'en' => 'Extracurricular activities play a crucial role in the holistic development of students at EduEx School and College.',
                    'bn' => 'শিক্ষার্থীদের সামগ্রিক বিকাশে পাঠ্যক্রম বহির্ভূত কার্যক্রম অত্যন্ত গুরুত্বপূর্ণ ভূমিকা পালন করে।'
                ],
                'desc' => [
                    'en' => '<p>At EduEx School and College, we believe that education extends beyond the four walls of a classroom. Engaging in sports, arts, and debate clubs helps students develop leadership skills and teamwork.</p><p>We strongly encourage all our students to participate in at least one extracurricular activity to ensure a balanced academic life.</p>',
                    'bn' => '<p>এডুএক্স স্কুল এন্ড কলেজে আমরা বিশ্বাস করি যে, শিক্ষা কেবল শ্রেণীকক্ষের চার দেয়ালের মধ্যে সীমাবদ্ধ নয়। খেলাধুলা, শিল্পকলা এবং বিতর্ক ক্লাবে অংশ নেওয়া শিক্ষার্থীদের নেতৃত্ব ও দলগত দক্ষতা বৃদ্ধিতে সহায়তা করে।</p><p>আমরা আমাদের সব শিক্ষার্থীকে অন্তত একটি পাঠ্যক্রম বহির্ভূত কার্যক্রমে অংশ নিতে উৎসাহিত করি।</p>'
                ]
            ],
            [
                'slug' => 'science-fair-2026-success',
                'title' => [
                    'en' => 'Outstanding Success in the Annual Science Fair 2026', 
                    'bn' => 'বার্ষিক বিজ্ঞান মেলা ২০২৬-এ অসামান্য সাফল্য'
                ],
                'image' => 'blog/02.jpg',
                'days_ago' => 12,
                'author' => ['en' => 'Science Department', 'bn' => 'বিজ্ঞান বিভাগ'],
                'short' => [
                    'en' => 'Our students showcased brilliant innovative projects at the regional Science Fair this year.',
                    'bn' => 'আমাদের শিক্ষার্থীরা এই বছর আঞ্চলিক বিজ্ঞান মেলায় অসাধারণ উদ্ভাবনী প্রজেক্ট প্রদর্শন করেছে।'
                ],
                'desc' => [
                    'en' => '<p>We are incredibly proud to announce that the students of EduEx School and College secured the first runner-up position in the regional Science Fair 2026.</p><p>Projects focused on renewable energy and robotics gained high praise from the judges and visitors alike.</p>',
                    'bn' => '<p>আমরা অত্যন্ত গর্বের সাথে জানাচ্ছি যে, এডুএক্স স্কুল এন্ড কলেজের শিক্ষার্থীরা আঞ্চলিক বিজ্ঞান মেলা ২০২৬-এ প্রথম রানার আপ স্থান অর্জন করেছে।</p><p>নবায়নযোগ্য শক্তি এবং রোবোটিক্স সম্পর্কিত প্রজেক্টগুলো বিচারক এবং দর্শকদের ব্যাপক প্রশংসা কুড়িয়েছে।</p>'
                ]
            ],
            [
                'slug' => 'preparing-for-ssc-hsc-board-exams',
                'title' => [
                    'en' => 'Effective Tips for Preparing for SSC and HSC Board Exams', 
                    'bn' => 'এসএসসি এবং এইচএসসি বোর্ড পরীক্ষার প্রস্তুতির কার্যকরী টিপস'
                ],
                'image' => 'blog/03.jpg',
                'days_ago' => 20,
                'author' => ['en' => 'Academic Coordinator', 'bn' => 'একাডেমিক কোঅর্ডিনেটর'],
                'short' => [
                    'en' => 'A comprehensive guide for our students to manage time and study effectively for their upcoming board exams.',
                    'bn' => 'আসন্ন বোর্ড পরীক্ষার জন্য কীভাবে সময় পরিচালনা এবং কার্যকরভাবে পড়াশোনা করতে হবে, তার একটি নির্দেশিকা।'
                ],
                'desc' => [
                    'en' => '<p>Board exams can be stressful, but with the right strategy, success is guaranteed. Start by creating a realistic study schedule and stick to it. Focus on understanding core concepts rather than memorizing.</p><p>EduEx School and College is organizing special model test sessions to help students evaluate their preparation.</p>',
                    'bn' => '<p>বোর্ড পরীক্ষা মানসিক চাপের কারণ হতে পারে, তবে সঠিক কৌশল অবলম্বন করলে সাফল্য নিশ্চিত। একটি বাস্তবসম্মত অধ্যয়নের সময়সূচী তৈরি করুন। মুখস্থ করার চেয়ে মূল ধারণাগুলো বোঝার দিকে মনোযোগ দিন।</p><p>শিক্ষার্থীদের প্রস্তুতি মূল্যায়নের জন্য এডুএক্স স্কুল এন্ড কলেজ বিশেষ মডেল টেস্ট সেশনের আয়োজন করছে।</p>'
                ]
            ],
        ];

        $authorPhoto = $this->copyIntoStorage('blog/author.jpg', 'site/blog-author.jpg');
        $galleryImage1 = $this->copyIntoStorage('blog/01.jpg', 'site/blog-gallery-1.jpg');
        $galleryImage2 = $this->copyIntoStorage('blog/02.jpg', 'site/blog-gallery-2.jpg');

        foreach ($posts as $index => $post) {
            $image = $this->copyIntoStorage($post['image'], "site/blog/{$post['slug']}.jpg");

            BlogPost::updateOrCreate(
                ['slug' => $post['slug']],
                [
                    'title' => $post['title'],
                    'image' => $image,
                    'published_at' => now()->subDays($post['days_ago'])->format('Y-m-d'),
                    'author_name' => $post['author'],
                    'short_description' => $post['short'],
                    'description' => $post['desc'],
                    'author_photo' => $authorPhoto,
                    'author_bio' => [
                        'en' => 'A dedicated member of the EduEx community.',
                        'bn' => 'এডুএক্স সম্প্রদায়ের একজন নিবেদিত সদস্য।'
                    ],
                    'gallery_image_1' => $galleryImage1,
                    'gallery_image_2' => $galleryImage2,
                    'tags' => collect($tagSet)->map(fn ($tag) => ['tag' => $tag])->all(),
                    'is_active' => true,
                    'sort_order' => $index + 1,
                ]
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
