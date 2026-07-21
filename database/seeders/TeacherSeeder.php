<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\TeacherPageSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedPageSettings();
        $this->seedTeachers();
    }

    protected function seedPageSettings(): void
    {
        $breadcrumbImage = $this->copyIntoStorage('breadcrumb/01.jpg', 'site/teachers-breadcrumb.jpg');
        $settings = TeacherPageSetting::query()->first() ?? new TeacherPageSetting();

        $settings->fill([
            'section_tagline' => ['en' => 'Our Teachers', 'bn' => 'আমাদের শিক্ষকবৃন্দ', 'ar' => 'معلمونا'],
            'section_title' => [
                'en' => 'Meet With Our Teachers',
                'bn' => 'আমাদের শিক্ষকদের সাথে পরিচিত হন',
                'ar' => 'تعرف على معلمينا',
            ],
            'section_highlight' => ['en' => 'Teachers', 'bn' => 'শিক্ষক', 'ar' => 'المعلمين'],
            'section_description' => [
                'en' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
                'bn' => 'এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।',
                'ar' => 'من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.',
            ],
            'breadcrumb_title' => ['en' => 'Teachers', 'bn' => 'শিক্ষকবৃন্দ', 'ar' => 'المعلمون'],
            'breadcrumb_image' => $breadcrumbImage ?? $settings->breadcrumb_image,
            'seo_title' => ['en' => 'Our Teachers', 'bn' => 'আমাদের শিক্ষকবৃন্দ', 'ar' => 'معلمونا'],
            'seo_description' => [
                'en' => 'Meet the teachers and staff of our school.',
                'bn' => 'আমাদের স্কুলের শিক্ষক ও কর্মীদের সাথে পরিচিত হন।',
                'ar' => 'تعرف على معلمي وموظفي مدرستنا.',
            ],
            'seo_keywords' => [
                'en' => 'teachers, faculty, staff',
                'bn' => 'শিক্ষক, অনুষদ, কর্মী',
                'ar' => 'المعلمون، أعضاء هيئة التدريس، الموظفون',
            ],
        ])->save();
    }

    protected function seedTeachers(): void
    {
        $skillSet = [
            ['label' => ['en' => 'Communication', 'bn' => 'যোগাযোগ', 'ar' => 'التواصل'], 'percentage' => 85],
            ['label' => ['en' => 'Relationship', 'bn' => 'সম্পর্ক', 'ar' => 'العلاقات'], 'percentage' => 65],
            ['label' => ['en' => 'Creative Work', 'bn' => 'সৃজনশীল কাজ', 'ar' => 'العمل الإبداعي'], 'percentage' => 75],
        ];

        $biography = [
            'en' => '<p>Sed ut perspiciatis unde omnis totam rem chitecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p><p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>',
            'bn' => '<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>তিনি দীর্ঘদিন ধরে আমাদের প্রতিষ্ঠানে নিষ্ঠার সাথে দায়িত্ব পালন করে আসছেন।</p>',
            'ar' => '<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>لقد خدم بإخلاص في مؤسستنا لسنوات عديدة.</p>',
        ];

        $teachers = [
            [
                'slug' => 'angela-t-vigil',
                'name' => ['en' => 'Angela T. Vigil', 'bn' => 'অ্যাঞ্জেলা টি. ভিজিল', 'ar' => 'أنجيلا تي. فيجيل'],
                'designation' => ['en' => 'Associate Professor', 'bn' => 'সহযোগী অধ্যাপক', 'ar' => 'أستاذ مشارك'],
                'photo' => 'team/01.jpg',
                'email' => 'angela@example.com',
                'phone' => '+880 1812-345671',
            ],
            [
                'slug' => 'frank-a-mitchell',
                'name' => ['en' => 'Frank A. Mitchell', 'bn' => 'ফ্র্যাঙ্ক এ. মিচেল', 'ar' => 'فرانك إيه. ميتشل'],
                'designation' => ['en' => 'Associate Professor', 'bn' => 'সহযোগী অধ্যাপক', 'ar' => 'أستاذ مشارك'],
                'photo' => 'team/02.jpg',
                'email' => 'frank@example.com',
                'phone' => '+880 1812-345672',
            ],
            [
                'slug' => 'susan-d-lunsford',
                'name' => ['en' => 'Susan D. Lunsford', 'bn' => 'সুসান ডি. লান্সফোর্ড', 'ar' => 'سوزان دي. لونسفورد'],
                'designation' => ['en' => 'CEO & Founder', 'bn' => 'সিইও ও প্রতিষ্ঠাতা', 'ar' => 'الرئيس التنفيذي والمؤسس'],
                'photo' => 'team/03.jpg',
                'email' => 'susan@example.com',
                'phone' => '+880 1812-345673',
            ],
            [
                'slug' => 'dennis-a-pruitt',
                'name' => ['en' => 'Dennis A. Pruitt', 'bn' => 'ডেনিস এ. প্রুইট', 'ar' => 'دينيس إيه. برويت'],
                'designation' => ['en' => 'Associate Professor', 'bn' => 'সহযোগী অধ্যাপক', 'ar' => 'أستاذ مشارك'],
                'photo' => 'team/04.jpg',
                'email' => 'dennis@example.com',
                'phone' => '+880 1812-345674',
            ],
        ];

        foreach ($teachers as $index => $teacher) {
            $photo = $this->copyIntoStorage($teacher['photo'], "site/teachers/{$teacher['slug']}.jpg");

            Teacher::updateOrCreate(
                ['slug' => $teacher['slug']],
                [
                    'name' => $teacher['name'],
                    'designation' => $teacher['designation'],
                    'photo' => $photo,
                    'short_intro' => [
                        'en' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
                        'bn' => 'এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।',
                        'ar' => 'من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.',
                    ],
                    'address' => ['en' => 'Chittagong, Bangladesh', 'bn' => 'চট্টগ্রাম, বাংলাদেশ', 'ar' => 'شيتاغونغ، بنغلاديش'],
                    'email' => $teacher['email'],
                    'phone' => $teacher['phone'],
                    'facebook_url' => 'https://facebook.com',
                    'whatsapp_url' => 'https://wa.me/8801812345678',
                    'behance_url' => 'https://behance.net',
                    'pinterest_url' => 'https://pinterest.com',
                    'linkedin_url' => 'https://linkedin.com',
                    'biography' => $biography,
                    'skills' => $skillSet,
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
