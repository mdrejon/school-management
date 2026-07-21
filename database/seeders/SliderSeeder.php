<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $slides = [
            [
                'source' => 'slider-1.jpg',
                'sub_title' => ['en' => 'Welcome To Our School !', 'bn' => 'আমাদের স্কুলে স্বাগতম!', 'ar' => 'مرحباً بكم في مدرستنا!'],
                'title' => ['en' => 'Start Your Beautiful And Bright Future', 'bn' => 'আপনার সুন্দর ও উজ্জ্বল ভবিষ্যৎ শুরু করুন', 'ar' => 'ابدأ مستقبلك الجميل والمشرق'],
                'highlight' => ['en' => 'Bright', 'bn' => 'উজ্জ্বল', 'ar' => 'المشرق'],
                'description' => [
                    'en' => 'Nurturing every student with quality education, dedicated teachers, and a safe, inspiring campus.',
                    'bn' => 'মানসম্মত শিক্ষা, নিবেদিতপ্রাণ শিক্ষক এবং একটি নিরাপদ, অনুপ্রেরণাদায়ক ক্যাম্পাসে প্রতিটি শিক্ষার্থীকে গড়ে তোলা।',
                    'ar' => 'نرعى كل طالب بتعليم جيد ومعلمين متفانين وحرم جامعي آمن وملهم.',
                ],
                'button_text' => ['en' => 'About More', 'bn' => 'বিস্তারিত জানুন', 'ar' => 'المزيد عنا'],
                'button_url' => '/about',
                'button2_text' => ['en' => 'Contact Us', 'bn' => 'যোগাযোগ করুন', 'ar' => 'تواصل معنا'],
                'button2_url' => '/contact',
            ],
            [
                'source' => 'slider-2.jpg',
                'sub_title' => ['en' => 'Excellence In Education', 'bn' => 'শিক্ষায় উৎকর্ষতা', 'ar' => 'التميز في التعليم'],
                'title' => ['en' => 'Empowering Minds For Tomorrow', 'bn' => 'আগামীর জন্য মনন তৈরি করছি', 'ar' => 'تمكين العقول من أجل الغد'],
                'highlight' => ['en' => 'Empowering', 'bn' => 'মনন', 'ar' => 'تمكين'],
                'description' => [
                    'en' => 'A modern curriculum blended with strong values to help every child reach their full potential.',
                    'bn' => 'প্রতিটি শিশুর সম্পূর্ণ সম্ভাবনা বিকাশে আধুনিক পাঠ্যক্রম ও মূল্যবোধের সমন্বয়।',
                    'ar' => 'منهج حديث ممزوج بقيم راسخة لمساعدة كل طفل على تحقيق إمكاناته الكاملة.',
                ],
                'button_text' => ['en' => 'Our Programs', 'bn' => 'আমাদের প্রোগ্রাম', 'ar' => 'برامجنا'],
                'button_url' => '/academic',
                'button2_text' => ['en' => 'Apply Now', 'bn' => 'আবেদন করুন', 'ar' => 'قدم الآن'],
                'button2_url' => '/admission',
            ],
            [
                'source' => 'slider-3.jpg',
                'sub_title' => ['en' => 'Join Our Community', 'bn' => 'আমাদের কমিউনিটিতে যোগ দিন', 'ar' => 'انضم إلى مجتمعنا'],
                'title' => ['en' => 'Where Every Student Truly Belongs', 'bn' => 'যেখানে প্রতিটি শিক্ষার্থী সত্যিকারের আপন', 'ar' => 'حيث ينتمي كل طالب حقاً'],
                'highlight' => ['en' => 'Belongs', 'bn' => 'আপন', 'ar' => 'ينتمي'],
                'description' => [
                    'en' => 'State-of-the-art facilities, caring mentors, and a vibrant campus life await your child.',
                    'bn' => 'অত্যাধুনিক সুযোগ-সুবিধা, যত্নশীল শিক্ষক এবং প্রাণবন্ত ক্যাম্পাস জীবন আপনার সন্তানের জন্য অপেক্ষা করছে।',
                    'ar' => 'مرافق حديثة ومعلمون مهتمون وحياة جامعية نابضة بالحياة في انتظار طفلك.',
                ],
                'button_text' => ['en' => 'Explore Campus', 'bn' => 'ক্যাম্পাস দেখুন', 'ar' => 'استكشف الحرم الجامعي'],
                'button_url' => '/campus-tour',
                'button2_text' => ['en' => 'Contact Us', 'bn' => 'যোগাযোগ করুন', 'ar' => 'اتصل بنا'],
                'button2_url' => '/contact',
            ],
        ];

        foreach ($slides as $index => $slide) {
            $sourcePath = public_path("frontend/assets/img/slider/{$slide['source']}");
            $storedPath = "sliders/{$slide['source']}";

            if (is_file($sourcePath) && ! Storage::disk('public')->exists($storedPath)) {
                Storage::disk('public')->put($storedPath, file_get_contents($sourcePath));
            }

            Slider::updateOrCreate(
                ['image' => $storedPath],
                [
                    'sub_title' => $slide['sub_title'],
                    'title' => $slide['title'],
                    'highlight' => $slide['highlight'],
                    'description' => $slide['description'],
                    'button_text' => $slide['button_text'],
                    'button_url' => $slide['button_url'],
                    'button2_text' => $slide['button2_text'],
                    'button2_url' => $slide['button2_url'],
                    'is_active' => true,
                    'sort_order' => $index + 1,
                ]
            );
        }
    }
}
