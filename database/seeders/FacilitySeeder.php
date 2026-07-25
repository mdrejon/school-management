<?php

namespace Database\Seeders;

use App\Models\Facility;
use App\Models\FacilityPageSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedPageSettings();
        $this->seedFacilities();
    }

    protected function seedPageSettings(): void
    {
        $breadcrumbImage = $this->copyIntoStorage('breadcrumb/01.jpg', 'site/facilities-breadcrumb.jpg');
        $settings = FacilityPageSetting::query()->first() ?? new FacilityPageSetting();

        $settings->fill([
            'section_tagline' => ['en' => 'Our Facilities', 'bn' => 'আমাদের সুযোগ-সুবিধা', 'ar' => 'مرافقنا'],
            'section_title' => [
                'en' => "Let's Check Our Facilities",
                'bn' => 'আমাদের সুযোগ-সুবিধা দেখুন',
                'ar' => 'تحقق من مرافقنا',
            ],
            'section_highlight' => ['en' => 'Facilities', 'bn' => 'সুযোগ-সুবিধা', 'ar' => 'المرافق'],
            'section_description' => [
                'en' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
                'bn' => 'এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।',
                'ar' => 'من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.',
            ],
            'breadcrumb_title' => ['en' => 'Our Facilities', 'bn' => 'আমাদের সুযোগ-সুবিধা', 'ar' => 'مرافقنا'],
            'breadcrumb_image' => $breadcrumbImage ?? $settings->breadcrumb_image,
            'seo_title' => ['en' => 'Our Facilities', 'bn' => 'আমাদের সুযোগ-সুবিধা', 'ar' => 'مرافقنا'],
            'seo_description' => [
                'en' => 'Browse the campus facilities available at our school.',
                'bn' => 'আমাদের স্কুলের ক্যাম্পাস সুযোগ-সুবিধা ব্রাউজ করুন।',
                'ar' => 'تصفح مرافق الحرم الجامعي المتاحة في مدرستنا.',
            ],
            'seo_keywords' => [
                'en' => 'facilities, campus, school facilities',
                'bn' => 'সুযোগ-সুবিধা, ক্যাম্পাস, স্কুল সুবিধা',
                'ar' => 'مرافق، حرم جامعي، مرافق مدرسية',
            ],
        ])->save();
    }

    protected function seedFacilities(): void
    {
        $facilities = [
            ['slug' => 'library-facility', 'title' => ['en' => 'Library Facility', 'bn' => 'গ্রন্থাগার সুবিধা', 'ar' => 'مرفق المكتبة'], 'image' => 'facility/01.jpg'],
            ['slug' => 'hall-facility', 'title' => ['en' => 'Hall Facility', 'bn' => 'হল সুবিধা', 'ar' => 'مرفق القاعة'], 'image' => 'facility/02.jpg'],
            ['slug' => 'canteen-food-facility', 'title' => ['en' => 'Canteen Food Facility', 'bn' => 'ক্যান্টিন খাদ্য সুবিধা', 'ar' => 'مرفق مقصف الطعام'], 'image' => 'facility/03.jpg'],
            ['slug' => 'transport-facility', 'title' => ['en' => 'Transport Facility', 'bn' => 'পরিবহন সুবিধা', 'ar' => 'مرفق النقل'], 'image' => 'facility/04.jpg'],
            ['slug' => 'lab-facility', 'title' => ['en' => 'Lab Facility', 'bn' => 'ল্যাব সুবিধা', 'ar' => 'مرفق المختبر'], 'image' => 'facility/05.jpg'],
            ['slug' => 'sports-facility', 'title' => ['en' => 'Sports Facility', 'bn' => 'ক্রীড়া সুবিধা', 'ar' => 'المرفق الرياضي'], 'image' => 'facility/06.jpg'],
        ];

        $galleryImage1 = $this->copyIntoStorage('facility/01.jpg', 'site/facilities-gallery-1.jpg');
        $galleryImage2 = $this->copyIntoStorage('facility/02.jpg', 'site/facilities-gallery-2.jpg');

        foreach ($facilities as $index => $facility) {
            $image = $this->copyIntoStorage($facility['image'], "site/facilities/{$facility['slug']}.jpg");

            Facility::updateOrCreate(
                ['slug' => $facility['slug']],
                [
                    'title' => $facility['title'],
                    'image' => $image,
                    'short_description' => [
                        'en' => 'There are many variations of passages orem psum available but the majority have suffer alteration in some form by injected.',
                        'bn' => 'অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।',
                        'ar' => 'هناك العديد من الاختلافات في المقاطع المتاحة، لكن معظمها قد خضع لتعديلات.',
                    ],
                    'description' => [
                        'en' => '<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>',
                        'bn' => '<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই সুবিধাটি শিক্ষার্থীদের জন্য গুরুত্বপূর্ণ ভূমিকা পালন করে।</p>',
                        'ar' => '<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>يلعب هذا المرفق دورًا مهمًا للطلاب.</p>',
                    ],
                    'gallery_image_1' => $galleryImage1,
                    'gallery_image_2' => $galleryImage2,
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
