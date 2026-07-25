<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use App\Models\PortfolioPageSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedPageSettings();
        $this->seedPortfolios();
    }

    protected function seedPageSettings(): void
    {
        $breadcrumbImage = $this->copyIntoStorage('breadcrumb/01.jpg', 'site/portfolios-breadcrumb.jpg');
        $settings = PortfolioPageSetting::query()->first() ?? new PortfolioPageSetting();

        $settings->fill([
            'section_tagline' => ['en' => 'Portfolio', 'bn' => 'পোর্টফোলিও', 'ar' => 'ملف الأعمال'],
            'section_title' => ['en' => 'Explore Our Portfolio', 'bn' => 'আমাদের পোর্টফোলিও দেখুন', 'ar' => 'استكشف ملف أعمالنا'],
            'section_highlight' => ['en' => 'Portfolio', 'bn' => 'পোর্টফোলিও', 'ar' => 'ملف الأعمال'],
            'section_description' => [
                'en' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
                'bn' => 'এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।',
                'ar' => 'من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.',
            ],
            'breadcrumb_title' => ['en' => 'Portfolio', 'bn' => 'পোর্টফোলিও', 'ar' => 'ملف الأعمال'],
            'breadcrumb_image' => $breadcrumbImage ?? $settings->breadcrumb_image,
            'seo_title' => ['en' => 'Portfolio', 'bn' => 'পোর্টফোলিও', 'ar' => 'ملف الأعمال'],
            'seo_description' => [
                'en' => 'Browse our school\'s notable projects and initiatives.',
                'bn' => 'আমাদের স্কুলের উল্লেখযোগ্য প্রকল্প ও উদ্যোগ ব্রাউজ করুন।',
                'ar' => 'تصفح مشاريع ومبادرات مدرستنا البارزة.',
            ],
            'seo_keywords' => [
                'en' => 'portfolio, projects, school initiatives',
                'bn' => 'পোর্টফোলিও, প্রকল্প, স্কুল উদ্যোগ',
                'ar' => 'ملف الأعمال، مشاريع، مبادرات مدرسية',
            ],
        ])->save();
    }

    protected function seedPortfolios(): void
    {
        $highlights = [
            ['en' => 'Fusce justo risus placerat in risus eget tincidunt consequat elit.', 'bn' => 'শিক্ষার্থীদের জন্য নিয়মিত স্বাস্থ্য পরীক্ষার ব্যবস্থা করা হয়।', 'ar' => 'يتم ترتيب فحوصات صحية منتظمة للطلاب.'],
            ['en' => 'Nunc fermentum sem sit amet dolor laoreet placerat.', 'bn' => 'জরুরি চিকিৎসা সেবা সার্বক্ষণিক পাওয়া যায়।', 'ar' => 'الرعاية الطبية الطارئة متاحة على مدار الساعة.'],
            ['en' => 'Nullam rhoncus dictum diam quis ultrices.', 'bn' => 'পুষ্টি সম্পর্কিত পরামর্শ নিয়মিত প্রদান করা হয়।', 'ar' => 'تُقدَّم استشارات التغذية بانتظام.'],
        ];

        $portfolios = [
            ['slug' => 'student-health-care', 'title' => ['en' => 'Student Health Care', 'bn' => 'শিক্ষার্থী স্বাস্থ্য সেবা', 'ar' => 'الرعاية الصحية للطلاب'], 'category' => ['en' => 'Health', 'bn' => 'স্বাস্থ্য', 'ar' => 'الصحة'], 'image' => 'portfolio/01.jpg'],
            ['slug' => 'digital-learning-program', 'title' => ['en' => 'Digital Learning Program', 'bn' => 'ডিজিটাল লার্নিং প্রোগ্রাম', 'ar' => 'برنامج التعلم الرقمي'], 'category' => ['en' => 'Education', 'bn' => 'শিক্ষা', 'ar' => 'التعليم'], 'image' => 'portfolio/02.jpg'],
            ['slug' => 'campus-renovation-project', 'title' => ['en' => 'Campus Renovation Project', 'bn' => 'ক্যাম্পাস সংস্কার প্রকল্প', 'ar' => 'مشروع تجديد الحرم الجامعي'], 'category' => ['en' => 'Infrastructure', 'bn' => 'অবকাঠামো', 'ar' => 'البنية التحتية'], 'image' => 'portfolio/03.jpg'],
            ['slug' => 'community-outreach-initiative', 'title' => ['en' => 'Community Outreach Initiative', 'bn' => 'কমিউনিটি আউটরিচ উদ্যোগ', 'ar' => 'مبادرة التواصل المجتمعي'], 'category' => ['en' => 'Community', 'bn' => 'কমিউনিটি', 'ar' => 'المجتمع'], 'image' => 'portfolio/04.jpg'],
            ['slug' => 'sports-development-program', 'title' => ['en' => 'Sports Development Program', 'bn' => 'ক্রীড়া উন্নয়ন প্রোগ্রাম', 'ar' => 'برنامج تطوير الرياضة'], 'category' => ['en' => 'Sports', 'bn' => 'ক্রীড়া', 'ar' => 'الرياضة'], 'image' => 'portfolio/05.jpg'],
            ['slug' => 'environmental-awareness-project', 'title' => ['en' => 'Environmental Awareness Project', 'bn' => 'পরিবেশ সচেতনতা প্রকল্প', 'ar' => 'مشروع التوعية البيئية'], 'category' => ['en' => 'Environment', 'bn' => 'পরিবেশ', 'ar' => 'البيئة'], 'image' => 'portfolio/06.jpg'],
        ];

        $galleryImage1 = $this->copyIntoStorage('portfolio/01.jpg', 'site/portfolios-gallery-1.jpg');
        $galleryImage2 = $this->copyIntoStorage('portfolio/02.jpg', 'site/portfolios-gallery-2.jpg');

        foreach ($portfolios as $index => $portfolio) {
            $image = $this->copyIntoStorage($portfolio['image'], "site/portfolios/{$portfolio['slug']}.jpg");

            Portfolio::updateOrCreate(
                ['slug' => $portfolio['slug']],
                [
                    'title' => $portfolio['title'],
                    'category' => $portfolio['category'],
                    'image' => $image,
                    'description' => [
                        'en' => '<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system.</p>',
                        'bn' => '<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই প্রকল্পটি প্রতিষ্ঠানের জন্য গুরুত্বপূর্ণ ভূমিকা পালন করে।</p>',
                        'ar' => '<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>يلعب هذا المشروع دورًا مهمًا لمؤسستنا.</p>',
                    ],
                    'gallery_image_1' => $galleryImage1,
                    'gallery_image_2' => $galleryImage2,
                    'highlight_title' => ['en' => 'Key Highlights', 'bn' => 'মূল বৈশিষ্ট্য', 'ar' => 'أبرز النقاط'],
                    'highlight_items' => collect($highlights)->map(fn ($text) => ['text' => $text])->all(),
                    'overview_title' => ['en' => 'Overview And Challenge', 'bn' => 'সংক্ষিপ্ত বিবরণ ও চ্যালেঞ্জ', 'ar' => 'نظرة عامة والتحدي'],
                    'overview_description' => [
                        'en' => 'Quisque a nisl id sem sollicitudin volutpat. Cras et commodo quam, vel congue ligula. Orci varius natoque penatibus et magnis dis parturient montes.',
                        'bn' => 'এই প্রকল্পটি বাস্তবায়নের সময় বেশ কিছু চ্যালেঞ্জ মোকাবিলা করতে হয়েছে, যা সফলভাবে সমাধান করা হয়েছে।',
                        'ar' => 'واجه هذا المشروع عدة تحديات أثناء التنفيذ، تم التغلب عليها بنجاح.',
                    ],
                    'client_name' => 'Roger M Collins',
                    'event_date' => now()->subMonths($index + 1)->format('Y-m-d'),
                    'cost' => '$1250.00',
                    'manager_name' => 'Doseph Brehmer',
                    'location' => 'Chittagong, Bangladesh',
                    'website_url' => 'example.com',
                    'rating' => 5,
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
