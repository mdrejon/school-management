<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventPageSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedPageSettings();
        $this->seedEvents();
    }

    protected function seedPageSettings(): void
    {
        $breadcrumbImage = $this->copyIntoStorage('breadcrumb/01.jpg', 'site/events-breadcrumb.jpg');
        $settings = EventPageSetting::query()->first() ?? new EventPageSetting();

        $settings->fill([
            'section_tagline' => ['en' => 'Events', 'bn' => 'অনুষ্ঠান', 'ar' => 'الفعاليات'],
            'section_title' => ['en' => 'Our Upcoming Events', 'bn' => 'আমাদের আসন্ন অনুষ্ঠানসমূহ', 'ar' => 'فعالياتنا القادمة'],
            'section_highlight' => ['en' => 'Events', 'bn' => 'অনুষ্ঠান', 'ar' => 'الفعاليات'],
            'section_description' => [
                'en' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
                'bn' => 'এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।',
                'ar' => 'من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.',
            ],
            'breadcrumb_title' => ['en' => 'Events', 'bn' => 'অনুষ্ঠান', 'ar' => 'الفعاليات'],
            'breadcrumb_image' => $breadcrumbImage ?? $settings->breadcrumb_image,
            'seo_title' => ['en' => 'Our Upcoming Events', 'bn' => 'আমাদের আসন্ন অনুষ্ঠানসমূহ', 'ar' => 'فعالياتنا القادمة'],
            'seo_description' => [
                'en' => 'See upcoming events, programs, and activities at our school.',
                'bn' => 'আমাদের স্কুলের আসন্ন অনুষ্ঠান, প্রোগ্রাম এবং কার্যক্রম দেখুন।',
                'ar' => 'اطلع على الفعاليات والبرامج والأنشطة القادمة في مدرستنا.',
            ],
            'seo_keywords' => [
                'en' => 'events, school programs, activities',
                'bn' => 'অনুষ্ঠান, স্কুল প্রোগ্রাম, কার্যক্রম',
                'ar' => 'فعاليات، برامج مدرسية، أنشطة',
            ],
        ])->save();
    }

    protected function seedEvents(): void
    {
        $contentBlocks = [
            [
                'title' => ['en' => 'About The Event', 'bn' => 'অনুষ্ঠান সম্পর্কে', 'ar' => 'حول الفعالية'],
                'description' => [
                    'en' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.',
                    'bn' => 'এই অনুষ্ঠানটি শিক্ষার্থীদের জন্য একটি গুরুত্বপূর্ণ অভিজ্ঞতা প্রদান করে।',
                    'ar' => 'توفر هذه الفعالية للطلاب تجربة مهمة.',
                ],
            ],
            [
                'title' => ['en' => 'Where The Event?', 'bn' => 'অনুষ্ঠানটি কোথায়?', 'ar' => 'أين تقام الفعالية؟'],
                'description' => [
                    'en' => 'All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.',
                    'bn' => 'অনুষ্ঠানটি আমাদের স্কুল ক্যাম্পাসে অনুষ্ঠিত হবে।',
                    'ar' => 'ستقام الفعالية في حرم مدرستنا.',
                ],
            ],
            [
                'title' => ['en' => 'Who This Event Is For?', 'bn' => 'এই অনুষ্ঠানটি কাদের জন্য?', 'ar' => 'لمن هذه الفعالية؟'],
                'description' => [
                    'en' => 'Generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.',
                    'bn' => 'এই অনুষ্ঠানটি সকল শিক্ষার্থী, অভিভাবক এবং শিক্ষকদের জন্য উন্মুক্ত।',
                    'ar' => 'هذه الفعالية مفتوحة لجميع الطلاب وأولياء الأمور والمعلمين.',
                ],
            ],
        ];

        $events = [
            [
                'slug' => 'high-school-program-2024',
                'title' => ['en' => 'High School Program 2024', 'bn' => 'হাই স্কুল প্রোগ্রাম ২০২৪', 'ar' => 'برنامج المدرسة الثانوية 2024'],
                'image' => 'event/01.jpg',
                'date' => '2024-06-16',
            ],
            [
                'slug' => 'annual-sports-day-2024',
                'title' => ['en' => 'Annual Sports Day 2024', 'bn' => 'বার্ষিক ক্রীড়া দিবস ২০২৪', 'ar' => 'يوم الرياضة السنوي 2024'],
                'image' => 'event/02.jpg',
                'date' => '2024-07-10',
            ],
            [
                'slug' => 'science-fair-2024',
                'title' => ['en' => 'Science Fair 2024', 'bn' => 'বিজ্ঞান মেলা ২০২৪', 'ar' => 'معرض العلوم 2024'],
                'image' => 'event/03.jpg',
                'date' => '2024-08-05',
            ],
            [
                'slug' => 'cultural-festival-2024',
                'title' => ['en' => 'Cultural Festival 2024', 'bn' => 'সাংস্কৃতিক উৎসব ২০২৪', 'ar' => 'المهرجان الثقافي 2024'],
                'image' => 'event/04.jpg',
                'date' => '2024-09-12',
            ],
            [
                'slug' => 'parents-teacher-meeting',
                'title' => ['en' => 'Parents Teacher Meeting', 'bn' => 'অভিভাবক শিক্ষক সভা', 'ar' => 'اجتماع أولياء الأمور والمعلمين'],
                'image' => 'event/05.jpg',
                'date' => '2024-10-01',
            ],
            [
                'slug' => 'annual-prize-giving-ceremony',
                'title' => ['en' => 'Annual Prize Giving Ceremony', 'bn' => 'বার্ষিক পুরস্কার বিতরণী অনুষ্ঠান', 'ar' => 'حفل توزيع الجوائز السنوي'],
                'image' => 'event/06.jpg',
                'date' => '2024-12-20',
            ],
        ];

        $galleryImage1 = $this->copyIntoStorage('event/01.jpg', 'site/events-gallery-1.jpg');
        $galleryImage2 = $this->copyIntoStorage('event/02.jpg', 'site/events-gallery-2.jpg');
        $organizerPhoto = $this->copyIntoStorage('event/author.jpg', 'site/events-organizer.jpg');

        foreach ($events as $index => $event) {
            $image = $this->copyIntoStorage($event['image'], "site/events/{$event['slug']}.jpg");

            Event::updateOrCreate(
                ['slug' => $event['slug']],
                [
                    'title' => $event['title'],
                    'location' => ['en' => 'Chittagong, Bangladesh', 'bn' => 'চট্টগ্রাম, বাংলাদেশ', 'ar' => 'شيتاغونغ، بنغلاديش'],
                    'image' => $image,
                    'event_date' => $event['date'],
                    'event_time' => '10.00AM - 04.00PM',
                    'short_description' => [
                        'en' => 'There are many variations of passages the majority have some injected humour.',
                        'bn' => 'অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।',
                        'ar' => 'هناك العديد من الاختلافات في المقاطع، ومعظمها يحتوي على بعض الفكاهة المضافة.',
                    ],
                    'content_blocks' => $contentBlocks,
                    'gallery_image_1' => $galleryImage1,
                    'gallery_image_2' => $galleryImage2,
                    'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d96708.34194156103!2d-74.03927096447748!3d40.759040329405195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4a01c8df6fb3cb8!2sSolomon%20R.%20Guggenheim%20Museum!5e0!3m2!1sen!2sbd!4v1619410634508!5m2!1sen!2s',
                    'sidebar_intro' => [
                        'en' => 'It is a long established fact that a reader will be distracted the readable content.',
                        'bn' => 'এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পঠনযোগ্য বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।',
                        'ar' => 'من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بالمحتوى القابل للقراءة.',
                    ],
                    'cost' => '150',
                    'button_text' => ['en' => 'Book Now', 'bn' => 'বুক করুন', 'ar' => 'احجز الآن'],
                    'button_url' => '/contact',
                    'organizer_name' => ['en' => 'Richard M Bell', 'bn' => 'রিচার্ড এম বেল', 'ar' => 'ريتشارد إم بيل'],
                    'organizer_photo' => $organizerPhoto,
                    'organizer_bio' => [
                        'en' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
                        'bn' => 'এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।',
                        'ar' => 'من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.',
                    ],
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
