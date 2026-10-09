<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\FaqPageSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Faq::truncate();
        FaqPageSetting::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->seedPageSettings();
        $this->seedFaqs();
    }

    protected function seedPageSettings(): void
    {
        $breadcrumbImage = $this->copyIntoStorage('breadcrumb/01.jpg', 'site/faq-breadcrumb.jpg');
        $settings = new FaqPageSetting();

        $settings->fill([
            'section_tagline' => ["en" => "FAQ", 'bn' => 'সাধারণ জিজ্ঞাসা'],
            'section_title' => [
                'en' => 'Frequently Asked Questions',
                'bn' => 'সাধারণ জিজ্ঞাসিত প্রশ্নসমূহ',
            ],
            'section_highlight' => ['en' => 'Questions', 'bn' => 'প্রশ্নসমূহ'],
            'section_description' => [
                'en' => 'Find quick answers to common questions about admissions, facilities, and academic programs at EduEx.',
                'bn' => 'এডুএক্সের ভর্তি, সুযোগ-সুবিধা এবং একাডেমিক প্রোগ্রাম সম্পর্কে সাধারণ প্রশ্নগুলোর উত্তর খুঁজুন।',
            ],
            'cta_button_text' => ['en' => 'Have More Questions?', 'bn' => 'আরও কোনো প্রশ্ন আছে?'],
            'cta_button_url' => '/contact',
            'breadcrumb_title' => ["en" => "FAQ", 'bn' => 'সাধারণ জিজ্ঞাসা'],
            'breadcrumb_image' => $breadcrumbImage ?? null,
            'seo_title' => ["en" => "FAQ | EduEx School and College", 'bn' => 'সাধারণ জিজ্ঞাসা | এডুএক্স স্কুল এন্ড কলেজ'],
            'seo_description' => [
                'en' => 'Find answers to frequently asked questions about our school and college.',
                'bn' => 'আমাদের স্কুল এবং কলেজ সম্পর্কে সাধারণ জিজ্ঞাসিত প্রশ্নের উত্তর খুঁজুন।',
            ],
            'seo_keywords' => [
                'en' => 'faq, school faq, admission queries, eduex help',
                'bn' => 'সাধারণ জিজ্ঞাসা, স্কুলের প্রশ্ন, ভর্তির প্রশ্ন, এডুএক্স সাহায্য',
            ],
        ])->save();
    }

    protected function seedFaqs(): void
    {
        $faqs = [
            [
                'question' => [
                    'en' => 'When does the admission process start?',
                    'bn' => 'ভর্তি প্রক্রিয়া কখন শুরু হয়?'
                ],
                'answer' => [
                    'en' => 'Admission usually starts in November for the upcoming academic year. Please check our website announcements for exact dates.',
                    'bn' => 'আগামী শিক্ষাবর্ষের জন্য ভর্তি সাধারণত নভেম্বরে শুরু হয়। সঠিক তারিখের জন্য আমাদের ওয়েবসাইটের বিজ্ঞপ্তি দেখুন।'
                ]
            ],
            [
                'question' => [
                    'en' => 'What curriculums do you offer?',
                    'bn' => 'আপনারা কোন শিক্ষাক্রম অফার করেন?'
                ],
                'answer' => [
                    'en' => 'We offer the national curriculum (NCTB) for primary, secondary (SSC), and higher secondary (HSC) levels.',
                    'bn' => 'আমরা প্রাথমিক, মাধ্যমিক (এসএসসি) এবং উচ্চ মাধ্যমিক (এইচএসসি) স্তরের জন্য জাতীয় শিক্ষাক্রম (এনসিটিবি) প্রদান করি।'
                ]
            ],
            [
                'question' => [
                    'en' => 'Do you have hostel facilities for students?',
                    'bn' => 'শিক্ষার্থীদের জন্য কি হোস্টেল সুবিধা আছে?'
                ],
                'answer' => [
                    'en' => 'Yes, we provide secure and well-maintained hostel facilities for students coming from outside the city.',
                    'bn' => 'হ্যাঁ, শহরের বাইরে থেকে আসা শিক্ষার্থীদের জন্য আমাদের নিরাপদ ও সুপরিচালিত হোস্টেল সুবিধা রয়েছে।'
                ]
            ],
            [
                'question' => [
                    'en' => 'Are there extracurricular activities?',
                    'bn' => 'এখানে কি পাঠ্যক্রম বহির্ভূত কার্যক্রম রয়েছে?'
                ],
                'answer' => [
                    'en' => 'Absolutely. We have various clubs, sports events, and cultural programs to ensure students\' holistic development.',
                    'bn' => 'অবশ্যই। শিক্ষার্থীদের সামগ্রিক বিকাশ নিশ্চিত করতে আমাদের বিভিন্ন ক্লাব, ক্রীড়া ইভেন্ট এবং সাংস্কৃতিক কর্মসূচি রয়েছে।'
                ]
            ]
        ];

        foreach ($faqs as $index => $faq) {
            Faq::create([
                'question' => $faq['question'],
                'answer' => $faq['answer'],
                'is_active' => true,
                'sort_order' => $index + 1,
            ]);
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
