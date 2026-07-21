<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $logo = $this->copyIntoStorage('logo/logo.png', 'site/logo.png');
        $footerLogo = $this->copyIntoStorage('logo/logo-light.png', 'site/logo-light.png');
        $videoThumbnail = $this->copyIntoStorage('video/01.jpg', 'site/video-thumbnail.jpg');
        $offerBackground = $this->copyIntoStorage('cta/01.jpg', 'site/offer-background.jpg');
        $chooseImage = $this->copyIntoStorage('choose/01.jpg', 'site/choose-image.jpg');
        $aboutImage1 = $this->copyIntoStorage('about/01.jpg', 'site/about-1.jpg');
        $aboutImage2 = $this->copyIntoStorage('about/02.jpg', 'site/about-2.jpg');
        $aboutImage3 = $this->copyIntoStorage('about/03.jpg', 'site/about-3.jpg');

        $settings = SiteSetting::query()->first() ?? new SiteSetting();

        $settings->fill([
            'site_name' => ['en' => 'WexNix School', 'bn' => 'ওয়েক্সনিক্স স্কুল', 'ar' => 'مدرسة ويكسنيكس'],
            'logo' => $logo ?? $settings->logo,
            'footer_logo' => $footerLogo ?? $settings->footer_logo,
            'address' => ['en' => 'Chittagong, Bangladesh', 'bn' => 'চট্টগ্রাম, বাংলাদেশ', 'ar' => 'شيتاغونغ، بنغلاديش'],
            'phone' => '+8801712345678',
            'email' => 'info@example.com',
            'facebook_url' => 'https://facebook.com',
            'instagram_url' => 'https://instagram.com',
            'youtube_url' => 'https://youtube.com',
            'whatsapp_url' => 'https://wa.me/8801712345678',
            'linkedin_url' => 'https://linkedin.com',
            'footer_about' => [
                'en' => 'We are dedicated to nurturing every student with quality education, dedicated teachers, and a safe, inspiring campus.',
                'bn' => 'আমরা মানসম্মত শিক্ষা, নিবেদিতপ্রাণ শিক্ষক এবং একটি নিরাপদ, অনুপ্রেরণাদায়ক ক্যাম্পাসে প্রতিটি শিক্ষার্থীকে গড়ে তুলতে প্রতিশ্রুতিবদ্ধ।',
                'ar' => 'نحن ملتزمون برعاية كل طالب بتعليم جيد ومعلمين متفانين وحرم جامعي آمن وملهم.',
            ],
            'copyright_text' => [
                'en' => 'All Rights Reserved.',
                'bn' => 'সর্বস্বত্ব সংরক্ষিত।',
                'ar' => 'جميع الحقوق محفوظة.',
            ],
            'institute_info' => [
                [
                    'label' => ['en' => 'Institute EIIN', 'bn' => 'ইনস্টিটিউট EIIN', 'ar' => 'رقم EIIN للمعهد'],
                    'value' => ['en' => '123456', 'bn' => '১২৩৪৫৬', 'ar' => '123456'],
                ],
                [
                    'label' => ['en' => 'Institution Code', 'bn' => 'প্রতিষ্ঠান কোড', 'ar' => 'رمز المؤسسة'],
                    'value' => ['en' => '987654321', 'bn' => '৯৮৭৬৫৪৩২১', 'ar' => '987654321'],
                ],
                [
                    'label' => ['en' => 'Center Code', 'bn' => 'কেন্দ্র কোড', 'ar' => 'رمز المركز'],
                    'value' => ['en' => '101', 'bn' => '১০১', 'ar' => '101'],
                ],
                [
                    'label' => ['en' => 'Estd Year', 'bn' => 'প্রতিষ্ঠার বছর', 'ar' => 'سنة التأسيس'],
                    'value' => ['en' => '1985', 'bn' => '১৯৮৫', 'ar' => '1985'],
                ],
            ],
            'cta_stats' => [
                [
                    'icon' => ['source' => 'lucide', 'value' => 'book-open'],
                    'value' => '500',
                    'label' => ['en' => 'Total Courses', 'bn' => 'মোট কোর্স', 'ar' => 'إجمالي الدورات'],
                ],
                [
                    'icon' => ['source' => 'lucide', 'value' => 'graduation-cap'],
                    'value' => '1900',
                    'label' => ['en' => 'Our Students', 'bn' => 'আমাদের শিক্ষার্থী', 'ar' => 'طلابنا'],
                ],
                [
                    'icon' => ['source' => 'lucide', 'value' => 'users'],
                    'value' => '750',
                    'label' => ['en' => 'Skilled Lecturers', 'bn' => 'দক্ষ প্রভাষক', 'ar' => 'محاضرون مهرة'],
                ],
                [
                    'icon' => ['source' => 'lucide', 'value' => 'award'],
                    'value' => '30',
                    'label' => ['en' => 'Win Awards', 'bn' => 'বিজয়ী পুরস্কার', 'ar' => 'جوائز فائزة'],
                ],
            ],
            'partner_logos' => collect(['02.png', '03.png', '04.png'])
                ->map(fn ($file) => ['image' => $this->copyIntoStorage("partner/{$file}", "site/partners/{$file}")])
                ->filter(fn ($item) => $item['image'] !== null)
                ->values()
                ->all(),
            'video_tagline' => ['en' => 'Latest Video', 'bn' => 'সাম্প্রতিক ভিডিও', 'ar' => 'أحدث فيديو'],
            'video_title' => [
                'en' => "Let's Check Our Latest Video",
                'bn' => 'আমাদের সাম্প্রতিক ভিডিও দেখুন',
                'ar' => 'شاهد أحدث فيديو لنا',
            ],
            'video_highlight' => ['en' => 'Latest', 'bn' => 'সাম্প্রতিক', 'ar' => 'أحدث'],
            'video_description' => [
                'en' => 'There are many variations of passages available but the majority have suffered alteration in some form by injected humour look even slightly believable.',
                'bn' => 'অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।',
                'ar' => 'هناك العديد من الاختلافات في المقاطع المتاحة، لكن معظمها قد خضع لتعديلات بشكل أو بآخر.',
            ],
            'video_button_text' => ['en' => 'Learn More', 'bn' => 'আরও জানুন', 'ar' => 'اعرف أكثر'],
            'video_button_url' => '#',
            'video_youtube_url' => 'https://www.youtube.com/watch?v=ckHzmP1evNU',
            'video_thumbnail' => $videoThumbnail ?? $settings->video_thumbnail,
            'offer_title' => [
                'en' => 'Our 20% Offer Running - Join Today For Your Course',
                'bn' => 'আমাদের ২০% অফার চলছে - আজই আপনার কোর্সে যোগ দিন',
                'ar' => 'عرضنا بخصم 20% مستمر - انضم اليوم لدورتك',
            ],
            'offer_description' => [
                'en' => "There are many variations of passages available but the majority have suffered alteration in some form by injected humour randomised words which don't look even slightly believable.",
                'bn' => 'অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে যা বিশ্বাসযোগ্য মনে হয় না।',
                'ar' => 'هناك العديد من الاختلافات في المقاطع المتاحة، لكن معظمها قد خضع لتعديلات لا تبدو معقولة على الإطلاق.',
            ],
            'offer_button_text' => ['en' => 'Apply Now', 'bn' => 'এখনই আবেদন করুন', 'ar' => 'قدم الآن'],
            'offer_button_url' => '#',
            'offer_background' => $offerBackground ?? $settings->offer_background,
            'choose_tagline' => ['en' => 'Why Choose Us', 'bn' => 'কেন আমাদের বেছে নেবেন', 'ar' => 'لماذا تختارنا'],
            'choose_title' => [
                'en' => 'We Are Expert & Do Our Best For Your Goal',
                'bn' => 'আমরা বিশেষজ্ঞ এবং আপনার লক্ষ্যের জন্য সর্বোচ্চ চেষ্টা করি',
                'ar' => 'نحن خبراء ونبذل قصارى جهدنا لتحقيق هدفك',
            ],
            'choose_highlight' => ['en' => 'Do Our Best', 'bn' => 'সর্বোচ্চ চেষ্টা করি', 'ar' => 'نبذل قصارى جهدنا'],
            'choose_description' => [
                'en' => 'It is a long established fact that a reader will be distracted by the readable content of a page when many desktop and web page editors looking at its layout.',
                'bn' => 'এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক একটি পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।',
                'ar' => 'من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بالمحتوى المقروء للصفحة.',
            ],
            'choose_image' => $chooseImage ?? $settings->choose_image,
            'choose_features' => [
                [
                    'icon' => ['source' => 'lucide', 'value' => 'user-round'],
                    'title' => ['en' => 'Expert Teachers', 'bn' => 'বিশেষজ্ঞ শিক্ষক', 'ar' => 'معلمون خبراء'],
                    'description' => ['en' => 'There are many variation of the suffered.', 'bn' => 'অনেক বৈচিত্র্য রয়েছে যা ভুগেছে।', 'ar' => 'هناك العديد من الاختلافات التي عانت.'],
                ],
                [
                    'icon' => ['source' => 'lucide', 'value' => 'library'],
                    'title' => ['en' => 'Courses Material', 'bn' => 'কোর্স উপকরণ', 'ar' => 'مواد الدورة'],
                    'description' => ['en' => 'There are many variation of the suffered.', 'bn' => 'অনেক বৈচিত্র্য রয়েছে যা ভুগেছে।', 'ar' => 'هناك العديد من الاختلافات التي عانت.'],
                ],
                [
                    'icon' => ['source' => 'lucide', 'value' => 'monitor-play'],
                    'title' => ['en' => 'Online Courses', 'bn' => 'অনলাইন কোর্স', 'ar' => 'دورات عبر الإنترنت'],
                    'description' => ['en' => 'There are many variation of the suffered.', 'bn' => 'অনেক বৈচিত্র্য রয়েছে যা ভুগেছে।', 'ar' => 'هناك العديد من الاختلافات التي عانت.'],
                ],
                [
                    'icon' => ['source' => 'lucide', 'value' => 'wallet'],
                    'title' => ['en' => 'Affordable Price', 'bn' => 'সাশ্রয়ী মূল্য', 'ar' => 'سعر معقول'],
                    'description' => ['en' => 'There are many variation of the suffered.', 'bn' => 'অনেক বৈচিত্র্য রয়েছে যা ভুগেছে।', 'ar' => 'هناك العديد من الاختلافات التي عانت.'],
                ],
            ],
            'skill_enroll_title' => ['en' => 'Start Your Enrollment', 'bn' => 'আপনার ভর্তি শুরু করুন', 'ar' => 'ابدأ التسجيل الخاص بك'],
            'skill_enroll_subtitle' => [
                'en' => 'We are variations of passages the have suffered.',
                'bn' => 'আমরা অনুচ্ছেদের বিভিন্নতা যা ভুগেছে।',
                'ar' => 'نحن اختلافات في المقاطع التي عانت.',
            ],
            'skill_tagline' => ['en' => 'Our Skills', 'bn' => 'আমাদের দক্ষতা', 'ar' => 'مهاراتنا'],
            'skill_title' => [
                'en' => 'Explore Your Creativity And Talent With Us',
                'bn' => 'আমাদের সাথে আপনার সৃজনশীলতা ও প্রতিভা অন্বেষণ করুন',
                'ar' => 'اكتشف إبداعك وموهبتك معنا',
            ],
            'skill_highlight' => ['en' => 'Creativity And Talent', 'bn' => 'সৃজনশীলতা ও প্রতিভা', 'ar' => 'الإبداع والموهبة'],
            'skill_description' => [
                'en' => "There are many variations of passages available but the majority have suffered alteration in some form by injected humour randomised words which don't look even slightly believable. If you are going to use passage you need sure there anything embarrassing first true generator on the Internet.",
                'bn' => 'অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে যা বিশ্বাসযোগ্য মনে হয় না।',
                'ar' => 'هناك العديد من الاختلافات في المقاطع المتاحة، لكن معظمها قد خضع لتعديلات لا تبدو معقولة على الإطلاق.',
            ],
            'skill_button_text' => ['en' => 'Learn More', 'bn' => 'আরও জানুন', 'ar' => 'اعرف أكثر'],
            'skill_button_url' => '#',
            'skill_items' => [
                ['label' => ['en' => 'Our Students', 'bn' => 'আমাদের শিক্ষার্থী', 'ar' => 'طلابنا'], 'percentage' => 85],
                ['label' => ['en' => 'Our Teachers', 'bn' => 'আমাদের শিক্ষক', 'ar' => 'معلمونا'], 'percentage' => 65],
                ['label' => ['en' => 'Our Courses', 'bn' => 'আমাদের কোর্স', 'ar' => 'دوراتنا'], 'percentage' => 75],
            ],
            'about_tagline' => ['en' => 'About Us', 'bn' => 'আমাদের সম্পর্কে', 'ar' => 'من نحن'],
            'about_title' => [
                'en' => 'Our WexNix Tion System Inspires You More.',
                'bn' => 'আমাদের ওয়েক্সনিক্স সিস্টেম আপনাকে আরও অনুপ্রাণিত করে।',
                'ar' => 'نظام WexNix لدينا يلهمك أكثر.',
            ],
            'about_highlight' => ['en' => 'Inspires', 'bn' => 'অনুপ্রাণিত করে', 'ar' => 'يلهمك'],
            'about_description' => [
                'en' => "There are many variations of passages available but the majority have suffered alteration in some form by injected humour randomised words which don't look even slightly believable. If you are going to use passage.",
                'bn' => 'অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে যা বিশ্বাসযোগ্য মনে হয় না।',
                'ar' => 'هناك العديد من الاختلافات في المقاطع المتاحة، لكن معظمها قد خضع لتعديلات لا تبدو معقولة على الإطلاق.',
            ],
            'about_quote' => [
                'en' => 'It is a long established fact that a reader will be distracted by the content of a page when looking at its reader for the long words layout.',
                'bn' => 'এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।',
                'ar' => 'من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.',
            ],
            'about_button_text' => ['en' => 'Discover More', 'bn' => 'আরও জানুন', 'ar' => 'اكتشف المزيد'],
            'about_button_url' => '#',
            'about_badge_icon' => ['source' => 'lucide', 'value' => 'lightbulb'],
            'about_badge_text' => [
                'en' => '30 Years Of Quality Service',
                'bn' => '৩০ বছরের মানসম্মত সেবা',
                'ar' => '30 عامًا من الخدمة الجيدة',
            ],
            'about_image_1' => $aboutImage1 ?? $settings->about_image_1,
            'about_image_2' => $aboutImage2 ?? $settings->about_image_2,
            'about_image_3' => $aboutImage3 ?? $settings->about_image_3,
            'about_items' => [
                [
                    'icon' => ['source' => 'lucide', 'value' => 'book-open'],
                    'title' => ['en' => 'WexNix tion Services', 'bn' => 'ওয়েক্সনিক্স সেবা', 'ar' => 'خدمات WexNix'],
                    'description' => ['en' => 'It is a long established fact that reader will to using content.', 'bn' => 'এটি একটি দীর্ঘদিনের প্রতিষ্ঠিত সত্য।', 'ar' => 'هذه حقيقة راسخة منذ زمن طويل.'],
                ],
                [
                    'icon' => ['source' => 'lucide', 'value' => 'globe'],
                    'title' => ['en' => 'International Hubs', 'bn' => 'আন্তর্জাতিক হাব', 'ar' => 'مراكز دولية'],
                    'description' => ['en' => 'It is a long established fact that reader will to using content.', 'bn' => 'এটি একটি দীর্ঘদিনের প্রতিষ্ঠিত সত্য।', 'ar' => 'هذه حقيقة راسخة منذ زمن طويل.'],
                ],
            ],
        ])->save();
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
