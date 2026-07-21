<?php

namespace Database\Seeders;

use App\Models\GalleryImage;
use App\Models\GalleryPageSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class GalleryImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedPageSettings();
        $this->seedImages();
    }

    protected function seedPageSettings(): void
    {
        $breadcrumbImage = $this->copyIntoStorage('breadcrumb/01.jpg', 'site/gallery-breadcrumb.jpg');
        $settings = GalleryPageSetting::query()->first() ?? new GalleryPageSetting();

        $settings->fill([
            'section_tagline' => ['en' => 'Gallery', 'bn' => 'গ্যালারি', 'ar' => 'معرض الصور'],
            'section_title' => ['en' => 'Our Photo Gallery', 'bn' => 'আমাদের ফটো গ্যালারি', 'ar' => 'معرض صورنا'],
            'section_highlight' => ['en' => 'Gallery', 'bn' => 'গ্যালারি', 'ar' => 'المعرض'],
            'section_description' => [
                'en' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
                'bn' => 'এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।',
                'ar' => 'من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.',
            ],
            'breadcrumb_title' => ['en' => 'Gallery', 'bn' => 'গ্যালারি', 'ar' => 'المعرض'],
            'breadcrumb_image' => $breadcrumbImage ?? $settings->breadcrumb_image,
            'seo_title' => ['en' => 'Our Photo Gallery', 'bn' => 'আমাদের ফটো গ্যালারি', 'ar' => 'معرض صورنا'],
            'seo_description' => [
                'en' => 'Browse photos from campus life, events, and activities at our school.',
                'bn' => 'আমাদের স্কুলের ক্যাম্পাস জীবন, অনুষ্ঠান এবং কার্যক্রমের ছবি ব্রাউজ করুন।',
                'ar' => 'تصفح صور الحياة الجامعية والفعاليات والأنشطة في مدرستنا.',
            ],
            'seo_keywords' => [
                'en' => 'gallery, photos, school events',
                'bn' => 'গ্যালারি, ছবি, স্কুল অনুষ্ঠান',
                'ar' => 'معرض، صور، فعاليات مدرسية',
            ],
        ])->save();
    }

    protected function seedImages(): void
    {
        for ($i = 1; $i <= 6; $i++) {
            $filename = str_pad((string) $i, 2, '0', STR_PAD_LEFT);
            $stored = $this->copyIntoStorage("gallery/{$filename}.jpg", "site/gallery/{$filename}.jpg");

            GalleryImage::updateOrCreate(
                ['image' => $stored],
                [
                    'caption' => [
                        'en' => "Campus Life {$i}",
                        'bn' => "ক্যাম্পাস জীবন {$i}",
                        'ar' => "الحياة الجامعية {$i}",
                    ],
                    'is_active' => true,
                    'sort_order' => $i,
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
