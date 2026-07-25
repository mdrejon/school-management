<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\FaqPageSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedPageSettings();
        $this->seedFaqs();
    }

    protected function seedPageSettings(): void
    {
        $breadcrumbImage = $this->copyIntoStorage('breadcrumb/01.jpg', 'site/faq-breadcrumb.jpg');
        $settings = FaqPageSetting::query()->first() ?? new FaqPageSetting();

        $settings->fill([
            'section_tagline' => ["en" => "Faq's", 'bn' => 'সাধারণ জিজ্ঞাসা', 'ar' => 'الأسئلة الشائعة'],
            'section_title' => [
                'en' => 'General frequently asked questions',
                'bn' => 'সাধারণ জিজ্ঞাসিত প্রশ্নসমূহ',
                'ar' => 'الأسئلة الشائعة العامة',
            ],
            'section_highlight' => ['en' => 'frequently', 'bn' => 'জিজ্ঞাসিত', 'ar' => 'الشائعة'],
            'section_description' => [
                'en' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even.',
                'bn' => 'আমাদের স্কুল সম্পর্কিত সাধারণ প্রশ্নের উত্তর এখানে পাওয়া যাবে। আরও তথ্যের জন্য অনুগ্রহ করে আমাদের সাথে যোগাযোগ করুন।',
                'ar' => 'يمكنكم العثور هنا على إجابات للأسئلة الشائعة المتعلقة بمدرستنا. لمزيد من المعلومات، يرجى الاتصال بنا.',
            ],
            'cta_button_text' => ['en' => 'Have Any Question ?', 'bn' => 'কোনো প্রশ্ন আছে ?', 'ar' => 'هل لديك سؤال؟'],
            'cta_button_url' => '/search',
            'breadcrumb_title' => ["en" => "Faq's", 'bn' => 'সাধারণ জিজ্ঞাসা', 'ar' => 'الأسئلة الشائعة'],
            'breadcrumb_image' => $breadcrumbImage ?? $settings->breadcrumb_image,
            'seo_title' => ["en" => "Faq's", 'bn' => 'সাধারণ জিজ্ঞাসা', 'ar' => 'الأسئلة الشائعة'],
            'seo_description' => [
                'en' => 'Find answers to frequently asked questions about our school.',
                'bn' => 'আমাদের স্কুল সম্পর্কে সাধারণ জিজ্ঞাসিত প্রশ্নের উত্তর খুঁজুন।',
                'ar' => 'اعثر على إجابات للأسئلة الشائعة حول مدرستنا.',
            ],
            'seo_keywords' => [
                'en' => 'faq, questions, help',
                'bn' => 'সাধারণ জিজ্ঞাসা, প্রশ্ন, সাহায্য',
                'ar' => 'الأسئلة الشائعة، أسئلة، مساعدة',
            ],
        ])->save();
    }

    protected function seedFaqs(): void
    {
        $faqs = [
            [
                'question' => ['en' => 'How Can do I apply ?', 'bn' => 'আমি কীভাবে আবেদন করতে পারি?', 'ar' => 'كيف يمكنني التقديم؟'],
                'answer' => [
                    'en' => 'We denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment so blinded by desire ante odio dignissim quam vitae pulvinar turpis.',
                    'bn' => 'আপনি আমাদের ওয়েবসাইটের ভর্তি পৃষ্ঠা থেকে অনলাইন আবেদন ফর্ম পূরণ করে আবেদন করতে পারেন, অথবা সরাসরি অফিসে যোগাযোগ করতে পারেন।',
                    'ar' => 'يمكنك التقديم من خلال ملء استمارة الطلب عبر الإنترنت من صفحة القبول في موقعنا الإلكتروني، أو زيارة المكتب مباشرة.',
                ],
            ],
            [
                'question' => ['en' => 'How Can I Become A Member ?', 'bn' => 'আমি কীভাবে সদস্য হতে পারি?', 'ar' => 'كيف يمكنني أن أصبح عضوًا؟'],
                'answer' => [
                    'en' => 'We denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment so blinded by desire ante odio dignissim quam vitae pulvinar turpis.',
                    'bn' => 'ভর্তি পরীক্ষায় উত্তীর্ণ হওয়ার পর প্রয়োজনীয় কাগজপত্র জমা দিয়ে সদস্যপদ নিশ্চিত করা যায়।',
                    'ar' => 'يمكن تأكيد العضوية بعد اجتياز اختبار القبول وتقديم المستندات المطلوبة.',
                ],
            ],
            [
                'question' => ['en' => 'What Payment Gateway You Support ?', 'bn' => 'আপনারা কোন পেমেন্ট গেটওয়ে সমর্থন করেন?', 'ar' => 'ما هي بوابات الدفع التي تدعمونها؟'],
                'answer' => [
                    'en' => 'We denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment so blinded by desire ante odio dignissim quam vitae pulvinar turpis.',
                    'bn' => 'আমরা মোবাইল ব্যাংকিং, ব্যাংক ট্রান্সফার এবং সরাসরি অফিস পেমেন্ট সমর্থন করি।',
                    'ar' => 'ندعم الخدمات المصرفية عبر الهاتف المحمول والتحويل البنكي والدفع المباشر في المكتب.',
                ],
            ],
            [
                'question' => ['en' => 'How Can I Cancel My Request ?', 'bn' => 'আমি কীভাবে আমার অনুরোধ বাতিল করতে পারি?', 'ar' => 'كيف يمكنني إلغاء طلبي؟'],
                'answer' => [
                    'en' => 'We denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment so blinded by desire ante odio dignissim quam vitae pulvinar turpis.',
                    'bn' => 'আপনি অফিসে সরাসরি যোগাযোগ করে অথবা ইমেইলের মাধ্যমে আপনার অনুরোধ বাতিল করতে পারেন।',
                    'ar' => 'يمكنك إلغاء طلبك عن طريق الاتصال بالمكتب مباشرة أو عبر البريد الإلكتروني.',
                ],
            ],
        ];

        foreach ($faqs as $index => $faq) {
            $existing = Faq::whereJsonContains('question->en', $faq['question']['en'])->first();

            if ($existing) {
                continue;
            }

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
