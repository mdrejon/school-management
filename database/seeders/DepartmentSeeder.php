<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\DepartmentPageSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedPageSettings();
        $this->seedDepartments();
    }

    protected function seedPageSettings(): void
    {
        $breadcrumbImage = $this->copyIntoStorage('breadcrumb/01.jpg', 'site/departments-breadcrumb.jpg');
        $settings = DepartmentPageSetting::query()->first() ?? new DepartmentPageSetting();

        $settings->fill([
            'section_tagline' => ['en' => 'Department', 'bn' => 'বিভাগ', 'ar' => 'القسم'],
            'section_title' => ['en' => 'Browse Our Department', 'bn' => 'আমাদের বিভাগসমূহ দেখুন', 'ar' => 'تصفح أقسامنا'],
            'section_highlight' => ['en' => 'Department', 'bn' => 'বিভাগ', 'ar' => 'القسم'],
            'section_description' => [
                'en' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
                'bn' => 'এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।',
                'ar' => 'من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.',
            ],
            'breadcrumb_title' => ['en' => 'Academics Department', 'bn' => 'একাডেমিক বিভাগ', 'ar' => 'القسم الأكاديمي'],
            'breadcrumb_image' => $breadcrumbImage ?? $settings->breadcrumb_image,
            'seo_title' => ['en' => 'Academics Department', 'bn' => 'একাডেমিক বিভাগ', 'ar' => 'القسم الأكاديمي'],
            'seo_description' => [
                'en' => 'Explore the academic departments offered at our school.',
                'bn' => 'আমাদের স্কুলে প্রদত্ত একাডেমিক বিভাগসমূহ দেখুন।',
                'ar' => 'استكشف الأقسام الأكاديمية المتوفرة في مدرستنا.',
            ],
            'seo_keywords' => [
                'en' => 'department, academics, faculty',
                'bn' => 'বিভাগ, একাডেমিক, অনুষদ',
                'ar' => 'قسم، أكاديمي، هيئة تدريس',
            ],
        ])->save();
    }

    protected function seedDepartments(): void
    {
        $requirements = [
            ['en' => 'Fusce justo risus placerat in risus eget tincidunt consequat elit.', 'bn' => 'শিক্ষার্থীদের ন্যূনতম জিপিএ প্রয়োজন।', 'ar' => 'يتطلب من الطلاب حد أدنى من المعدل التراكمي.'],
            ['en' => 'Nunc fermentum sem sit amet dolor laoreet placerat.', 'bn' => 'ভর্তি পরীক্ষায় উত্তীর্ণ হতে হবে।', 'ar' => 'يجب اجتياز امتحان القبول.'],
            ['en' => 'Nullam rhoncus dictum diam quis ultrices.', 'bn' => 'প্রয়োজনীয় কাগজপত্র জমা দিতে হবে।', 'ar' => 'يجب تقديم المستندات المطلوبة.'],
            ['en' => 'Integer quis lorem est suspendisse eu augue porta ullamcorper dictum.', 'bn' => 'সাক্ষাৎকারে উপস্থিত থাকতে হবে।', 'ar' => 'يجب حضور المقابلة الشخصية.'],
        ];

        $departments = [
            [
                'slug' => 'business-and-finance',
                'title' => ['en' => 'Business And Finance', 'bn' => 'ব্যবসা ও অর্থায়ন', 'ar' => 'الأعمال والتمويل'],
                'icon' => 'briefcase',
            ],
            [
                'slug' => 'law-and-criminology',
                'title' => ['en' => 'Law And Criminology', 'bn' => 'আইন ও অপরাধবিজ্ঞান', 'ar' => 'القانون وعلم الجريمة'],
                'icon' => 'scale',
            ],
            [
                'slug' => 'it-and-data-science',
                'title' => ['en' => 'IT And Data Science', 'bn' => 'আইটি ও ডেটা সায়েন্স', 'ar' => 'تكنولوجيا المعلومات وعلوم البيانات'],
                'icon' => 'database',
            ],
            [
                'slug' => 'health-and-medicine',
                'title' => ['en' => 'Health And Medicine', 'bn' => 'স্বাস্থ্য ও চিকিৎসা', 'ar' => 'الصحة والطب'],
                'icon' => 'heart-pulse',
            ],
            [
                'slug' => 'art-and-design',
                'title' => ['en' => 'Art And Design', 'bn' => 'শিল্প ও নকশা', 'ar' => 'الفن والتصميم'],
                'icon' => 'palette',
            ],
            [
                'slug' => 'information-technology',
                'title' => ['en' => 'Information Technology', 'bn' => 'তথ্য প্রযুক্তি', 'ar' => 'تكنولوجيا المعلومات'],
                'icon' => 'monitor',
            ],
            [
                'slug' => 'acting-and-drama',
                'title' => ['en' => 'Acting And Drama', 'bn' => 'অভিনয় ও নাটক', 'ar' => 'التمثيل والدراما'],
                'icon' => 'drama',
            ],
            [
                'slug' => 'human-resource',
                'title' => ['en' => 'Human Resource', 'bn' => 'মানব সম্পদ', 'ar' => 'الموارد البشرية'],
                'icon' => 'users',
            ],
        ];

        $image = $this->copyIntoStorage('department/single.jpg', 'site/departments-detail.jpg');
        $galleryImage1 = $this->copyIntoStorage('department/01.jpg', 'site/departments-gallery-1.jpg');
        $galleryImage2 = $this->copyIntoStorage('department/02.jpg', 'site/departments-gallery-2.jpg');

        foreach ($departments as $index => $department) {
            Department::updateOrCreate(
                ['slug' => $department['slug']],
                [
                    'icon' => ['source' => 'lucide', 'value' => $department['icon']],
                    'title' => $department['title'],
                    'short_description' => [
                        'en' => 'There are many variations of passages the majority have some injected humour.',
                        'bn' => 'অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।',
                        'ar' => 'هناك العديد من الاختلافات في المقاطع، ومعظمها يحتوي على بعض الفكاهة المضافة.',
                    ],
                    'image' => $image,
                    'description' => [
                        'en' => '<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system.</p>',
                        'bn' => '<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই বিভাগটি শিক্ষার্থীদের ব্যবহারিক ও তাত্ত্বিক জ্ঞান উভয়ই প্রদান করে।</p>',
                        'ar' => '<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>يوفر هذا القسم للطلاب المعرفة العملية والنظرية على حد سواء.</p>',
                    ],
                    'gallery_image_1' => $galleryImage1,
                    'gallery_image_2' => $galleryImage2,
                    'requirement_title' => ['en' => 'How To Prepare For The Exam', 'bn' => 'পরীক্ষার জন্য কীভাবে প্রস্তুতি নেবেন', 'ar' => 'كيفية الاستعداد للامتحان'],
                    'requirement_items' => collect($requirements)->map(fn ($text) => ['text' => $text])->all(),
                    'downloads' => [],
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
