<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
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
                'sub_title' => [
                    'en' => 'Welcome To Sitakund Kamil M.A Madrasah !',
                    'bn' => 'সীতাকুণ্ড কামিল এম.এ মাদরাসায় স্বাগতম!',
                    'ar' => 'مرحباً بكم في مدرسة وكلية سيتكوند كامل ماجستير!',
                ],
                'title' => [
                    'en' => '138 Years Of Islamic Education & Academic Excellence',
                    'bn' => '১৩৮ বছরের ইসলামি শিক্ষা ও একাডেমিক উৎকর্ষতা',
                    'ar' => '138 عاماً من التعليم الإسلامي والتميز الأكاديمي',
                ],
                'highlight' => [
                    'en' => '138 Years',
                    'bn' => '১৩৮ বছরের',
                    'ar' => '138 عاماً',
                ],
                'description' => [
                    'en' => 'Founded in 1886 by Maulana Obaidul Haq (R.), our legacy is one of resilience, scholarship, and service to the Ummah in Chattogram.',
                    'bn' => '১৮৮৬ সালে মাওলানা ওবায়দুল হক (রহ.) কর্তৃক প্রতিষ্ঠিত, আমাদের ঐতিহ্য হলো চট্টগ্রাম এবং উম্মাহর সেবায় দৃঢ়তা, পাণ্ডিত্য ও সেবার এক অনন্য নিদর্শন।',
                    'ar' => 'تأسست في عام 1886، إرثنا هو الصمود والمنح الدراسية وخدمة الأمة.',
                ],
                'button_text' => [
                    'en' => 'About Us',
                    'bn' => 'আমাদের সম্পর্কে',
                    'ar' => 'معلومات عنا',
                ],
                'button_url' => '/about',
                'button2_text' => [
                    'en' => 'Contact Us',
                    'bn' => 'যোগাযোগ করুন',
                    'ar' => 'تواصل معنا',
                ],
                'button2_url' => '/contact',
            ],
            [
                'source' => 'slider-2.jpg',
                'sub_title' => [
                    'en' => 'Comprehensive Islamic Studies!',
                    'bn' => 'পূর্ণাঙ্গ ইসলামি শিক্ষা!',
                    'ar' => 'دراسات إسلامية شاملة!',
                ],
                'title' => [
                    'en' => 'Academic Programs From Dakhil To Kamil',
                    'bn' => 'দাখিল থেকে কামিল পর্যন্ত পূর্ণাঙ্গ ইসলামি শিক্ষা',
                    'ar' => 'البرامج الأكاديمية من الداخل إلى الكامل',
                ],
                'highlight' => [
                    'en' => 'Dakhil To Kamil',
                    'bn' => 'দাখিল থেকে কামিল',
                    'ar' => 'من الداخل إلى الكامل',
                ],
                'description' => [
                    'en' => 'We offer comprehensive Islamic and modern education under one roof, producing well-rounded graduates ready for the challenges of today and tomorrow.',
                    'bn' => 'এক ছাদের নিচে পূর্ণাঙ্গ ইসলামি ও আধুনিক শিক্ষা প্রদান করে আমরা আজকের ও আগামী দিনের চ্যালেঞ্জ মোকাবেলায় প্রস্তুত আদর্শ গ্র্যাজুয়েট তৈরি করছি।',
                    'ar' => 'نقدم تعليماً إسلامياً وحديثاً شاملاً تحت سقف واحد، لنخرج خريجين متكاملين.',
                ],
                'button_text' => [
                    'en' => 'Our Programs',
                    'bn' => 'আমাদের প্রোগ্রামসমূহ',
                    'ar' => 'برامجنا',
                ],
                'button_url' => '/courses',
                'button2_text' => [
                    'en' => 'Apply Now',
                    'bn' => 'ভর্তি আবেদন',
                    'ar' => 'قدم الآن',
                ],
                'button2_url' => '/contact',
            ],
            [
                'source' => 'slider-3.jpg',
                'sub_title' => [
                    'en' => 'Expert Teachers & Rich Curriculum!',
                    'bn' => 'দক্ষ শিক্ষক ও সমৃদ্ধ পাঠ্যক্রম!',
                    'ar' => 'معلمون خبراء ومناهج غنية!',
                ],
                'title' => [
                    'en' => 'Deep-Rooted Islamic Scholarship & Modern Education',
                    'bn' => 'শিকড়-সন্ধানী ইসলামি জ্ঞান ও আধুনিক শিক্ষার সমন্বয়',
                    'ar' => 'منحة إسلامية عميقة الجذور وتعليم حديث',
                ],
                'highlight' => [
                    'en' => 'Modern Education',
                    'bn' => 'আধুনিক শিক্ষার',
                    'ar' => 'وتعليم حديث',
                ],
                'description' => [
                    'en' => 'Combining seasoned Islamic scholars with qualified modern educators, a dedicated Hafeziya program, and on-campus hostel facilities.',
                    'bn' => 'অভিজ্ঞ ইসলামি স্কলার ও যোগ্য আধুনিক শিক্ষকমণ্ডলী, নিবেদিত হিফজুল কুরআন প্রোগ্রাম এবং আবাসিক হোস্টেল সুবিধার এক অপূর্ব সমন্বয়।',
                    'ar' => 'الجمع بين علماء الإسلام المتمرسين والمعلمين المعاصرين المؤهلين وبرنامج حفظ مخصص.',
                ],
                'button_text' => [
                    'en' => 'Our Faculty',
                    'bn' => 'আমাদের শিক্ষকমণ্ডলী',
                    'ar' => 'أعضاء هيئة التدريس',
                ],
                'button_url' => '/teachers',
                'button2_text' => [
                    'en' => 'Learn More',
                    'bn' => 'আরও জানুন',
                    'ar' => 'اعرف المزيد',
                ],
                'button2_url' => '/about',
            ],
        ];

        // Clear existing sliders so the new EduEx slides take effect cleanly
        Slider::query()->delete();

        foreach ($slides as $index => $slide) {
            $sourcePath = public_path("frontend/assets/img/slider/{$slide['source']}");
            $storedPath = "sliders/{$slide['source']}";

            if (is_file($sourcePath) && ! Storage::disk('public')->exists($storedPath)) {
                Storage::disk('public')->put($storedPath, file_get_contents($sourcePath));
            }

            Slider::create([
                'image' => $storedPath,
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
            ]);
        }

        Cache::forget('sliders_homepage');
    }
}

