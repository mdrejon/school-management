<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $breadcrumbImage = $this->copyIntoStorage('breadcrumb/01.jpg', 'pages/about-us-breadcrumb.jpg');
        $aboutImage = $this->copyIntoStorage('about/01.jpg', 'pages/content/about-us-1.jpg');
        $ctaImage = $this->copyIntoStorage('cta/01.jpg', 'pages/content/about-us-cta.jpg');
        $aboutImageUrl = $aboutImage ? '/storage/'.$aboutImage : '';
        $ctaImageUrl = $ctaImage ? '/storage/'.$ctaImage : '';

        $page = Page::create([
            'slug' => 'about-us',
            'title' => ['en' => 'About Us', 'bn' => 'আমাদের সম্পর্কে', 'ar' => 'من نحن'],
            'breadcrumb_image' => $breadcrumbImage,
            'seo_title' => ['en' => 'About Us', 'bn' => 'আমাদের সম্পর্কে', 'ar' => 'من نحن'],
            'seo_description' => [
                'en' => 'Learn more about our school, our mission, and what makes us different.',
                'bn' => 'আমাদের স্কুল, আমাদের লক্ষ্য এবং আমাদের বৈশিষ্ট্য সম্পর্কে আরও জানুন।',
                'ar' => 'تعرف على المزيد حول مدرستنا ورسالتنا وما يميزنا.',
            ],
            'is_active' => true,
        ]);

        // Seeded as plain HTML (edited visually via Vvveb.js from here on)
        // rather than the old structured block tree — same wexnix_* theme
        // classes as before, so it renders identically on the public page.
        $page->setTranslation('content', 'en', $this->contentHtml(
            heading: 'Welcome To Our School',
            text: 'We denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment that they cannot foresee the pain and trouble that are bound to follow.',
            aboutImageUrl: $aboutImageUrl,
            ctaHeading: 'Join Our School Today',
            ctaDescription: 'Give your child the best start with a quality education in a caring environment.',
            ctaButtonLabel: 'Apply Now',
            ctaImageUrl: $ctaImageUrl,
        ));
        $page->setTranslation('content', 'bn', $this->contentHtml(
            heading: 'আমাদের স্কুলে স্বাগতম',
            text: 'আমাদের প্রতিষ্ঠানটি বহু বছর ধরে মানসম্মত শিক্ষা প্রদান করে আসছে এবং শিক্ষার্থীদের সার্বিক বিকাশে প্রতিশ্রুতিবদ্ধ।',
            aboutImageUrl: $aboutImageUrl,
            ctaHeading: 'আজই আমাদের স্কুলে যোগ দিন',
            ctaDescription: 'একটি যত্নশীল পরিবেশে মানসম্মত শিক্ষার মাধ্যমে আপনার সন্তানকে সেরা সূচনা দিন।',
            ctaButtonLabel: 'এখনই আবেদন করুন',
            ctaImageUrl: $ctaImageUrl,
        ));
        $page->setTranslation('content', 'ar', $this->contentHtml(
            heading: 'مرحبًا بكم في مدرستنا',
            text: 'تقدم مؤسستنا تعليمًا عالي الجودة منذ سنوات عديدة وهي ملتزمة بالتنمية الشاملة للطلاب.',
            aboutImageUrl: $aboutImageUrl,
            ctaHeading: 'انضم إلى مدرستنا اليوم',
            ctaDescription: 'امنح طفلك أفضل بداية من خلال تعليم عالي الجودة في بيئة رعاية.',
            ctaButtonLabel: 'قدم الآن',
            ctaImageUrl: $ctaImageUrl,
        ));
        $page->save();
    }

    protected function contentHtml(
        string $heading,
        string $text,
        string $aboutImageUrl,
        string $ctaHeading,
        string $ctaDescription,
        string $ctaButtonLabel,
        string $ctaImageUrl,
    ): string {
        return <<<HTML
            <h2 class="wexnix_pb-heading mb-4 text-left">{$heading}</h2>
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="wexnix_pb-text"><p>{$text}</p></div>
                </div>
                <div class="col-md-6">
                    <figure class="wexnix_pb-image"><img src="{$aboutImageUrl}" class="w-100" alt=""></figure>
                </div>
            </div>
            <div class="wexnix_cta-area mb-4" style="background-image: url('{$ctaImageUrl}');">
                <div class="wexnix_cta-wrapper">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="wexnix_cta-content">
                                <h1>{$ctaHeading}</h1>
                                <p>{$ctaDescription}</p>
                                <div class="wexnix_cta-btn">
                                    <a href="/search" class="wexnix_theme-btn">{$ctaButtonLabel}<i class="fas fa-arrow-right-long"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            HTML;
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
