<?php

namespace Database\Seeders;

use App\Models\BlogPageSetting;
use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedPageSettings();
        $this->seedPosts();
    }

    protected function seedPageSettings(): void
    {
        $breadcrumbImage = $this->copyIntoStorage('breadcrumb/01.jpg', 'site/blog-breadcrumb.jpg');
        $settings = BlogPageSetting::query()->first() ?? new BlogPageSetting();

        $settings->fill([
            'section_tagline' => ['en' => 'Our Blog', 'bn' => 'আমাদের ব্লগ', 'ar' => 'مدونتنا'],
            'section_title' => ['en' => 'Latest News & Blog', 'bn' => 'সর্বশেষ সংবাদ ও ব্লগ', 'ar' => 'آخر الأخبار والمدونة'],
            'section_highlight' => ['en' => 'Blog', 'bn' => 'ব্লগ', 'ar' => 'المدونة'],
            'section_description' => [
                'en' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
                'bn' => 'এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।',
                'ar' => 'من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.',
            ],
            'breadcrumb_title' => ['en' => 'Our Blog', 'bn' => 'আমাদের ব্লগ', 'ar' => 'مدونتنا'],
            'breadcrumb_image' => $breadcrumbImage ?? $settings->breadcrumb_image,
            'seo_title' => ['en' => 'Our Blog', 'bn' => 'আমাদের ব্লগ', 'ar' => 'مدونتنا'],
            'seo_description' => [
                'en' => 'Read the latest news and articles from our school.',
                'bn' => 'আমাদের স্কুলের সর্বশেষ সংবাদ ও নিবন্ধ পড়ুন।',
                'ar' => 'اقرأ آخر الأخبار والمقالات من مدرستنا.',
            ],
            'seo_keywords' => [
                'en' => 'blog, news, articles, school blog',
                'bn' => 'ব্লগ, সংবাদ, নিবন্ধ, স্কুল ব্লগ',
                'ar' => 'مدونة، أخبار، مقالات، مدونة مدرسية',
            ],
        ])->save();
    }

    protected function seedPosts(): void
    {
        $tagSet = [
            ['en' => 'Course', 'bn' => 'কোর্স', 'ar' => 'دورة'],
            ['en' => 'Students', 'bn' => 'শিক্ষার্থী', 'ar' => 'الطلاب'],
            ['en' => 'Academics', 'bn' => 'একাডেমিক', 'ar' => 'أكاديمي'],
        ];

        $posts = [
            [
                'slug' => 'there-are-many-variations-passage-have-suffered-available',
                'title' => ['en' => 'There are many variations passage have suffered available.', 'bn' => 'অনেক ধরনের অনুচ্ছেদের ভিন্নতা রয়েছে যা পরিবর্তিত হয়েছে।', 'ar' => 'هناك العديد من الاختلافات في المقاطع المتاحة.'],
                'image' => 'blog/01.jpg',
                'days_ago' => 5,
            ],
            [
                'slug' => 'a-reader-will-be-distracted-by-the-readable-content',
                'title' => ['en' => 'A reader will be distracted by the readable content.', 'bn' => 'একজন পাঠক পঠনযোগ্য বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।', 'ar' => 'سيتشتت انتباه القارئ بالمحتوى القابل للقراءة.'],
                'image' => 'blog/02.jpg',
                'days_ago' => 12,
            ],
            [
                'slug' => 'many-desktop-publishing-packages-use-lorem-ipsum',
                'title' => ['en' => 'Many desktop publishing packages use Lorem Ipsum.', 'bn' => 'অনেক ডেস্কটপ পাবলিশিং প্যাকেজ লরেম ইপসাম ব্যবহার করে।', 'ar' => 'تستخدم العديد من حزم النشر المكتبي نص لوريم إيبسوم.'],
                'image' => 'blog/03.jpg',
                'days_ago' => 20,
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
                    'author_name' => ['en' => 'Alicia Davis', 'bn' => 'অ্যালিসিয়া ডেভিস', 'ar' => 'أليشا ديفيس'],
                    'short_description' => [
                        'en' => 'There are many variations of passages the majority have suffered in some injected humour.',
                        'bn' => 'অনেক ধরনের অনুচ্ছেদ পাওয়া যায় যার বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।',
                        'ar' => 'هناك العديد من الاختلافات في المقاطع التي عانت معظمها من بعض الفكاهة المضافة.',
                    ],
                    'description' => [
                        'en' => '<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system.</p>',
                        'bn' => '<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই নিবন্ধটি শিক্ষার্থীদের জন্য গুরুত্বপূর্ণ তথ্য প্রদান করে।</p>',
                        'ar' => '<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>توفر هذه المقالة معلومات مهمة للطلاب.</p>',
                    ],
                    'author_photo' => $authorPhoto,
                    'author_bio' => [
                        'en' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
                        'bn' => 'এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।',
                        'ar' => 'من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.',
                    ],
                    'gallery_image_1' => $galleryImage1,
                    'gallery_image_2' => $galleryImage2,
                    'tags' => collect($tagSet)->map(fn ($tag) => ['tag' => $tag])->all(),
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
