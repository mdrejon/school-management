<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CoursePageSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedPageSettings();
        $this->seedCourses();
    }

    protected function seedPageSettings(): void
    {
        $breadcrumbImage = $this->copyIntoStorage('breadcrumb/01.jpg', 'site/courses-breadcrumb.jpg');
        $settings = CoursePageSetting::query()->first() ?? new CoursePageSetting();

        $settings->fill([
            'section_tagline' => ['en' => 'Our Courses', 'bn' => 'আমাদের কোর্স', 'ar' => 'دوراتنا'],
            'section_title' => [
                'en' => "Let's Check Our Courses",
                'bn' => 'আমাদের কোর্সগুলো দেখুন',
                'ar' => 'تحقق من دوراتنا',
            ],
            'section_highlight' => ['en' => 'Courses', 'bn' => 'কোর্স', 'ar' => 'دورات'],
            'section_description' => [
                'en' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
                'bn' => 'এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।',
                'ar' => 'من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.',
            ],
            'breadcrumb_title' => ['en' => 'Our Courses', 'bn' => 'আমাদের কোর্স', 'ar' => 'دوراتنا'],
            'breadcrumb_image' => $breadcrumbImage ?? $settings->breadcrumb_image,
            'seo_title' => [
                'en' => 'Our Courses',
                'bn' => 'আমাদের কোর্স',
                'ar' => 'دوراتنا',
            ],
            'seo_description' => [
                'en' => 'Browse the courses offered by our school — duration, fees, seats, and requirements for each program.',
                'bn' => 'আমাদের স্কুলের কোর্সসমূহ ব্রাউজ করুন — সময়কাল, ফি, আসন এবং প্রতিটি প্রোগ্রামের প্রয়োজনীয়তা।',
                'ar' => 'تصفح الدورات التي تقدمها مدرستنا - المدة والرسوم والمقاعد ومتطلبات كل برنامج.',
            ],
            'seo_keywords' => [
                'en' => 'courses, admission, school courses',
                'bn' => 'কোর্স, ভর্তি, স্কুল কোর্স',
                'ar' => 'دورات، القبول، دورات المدرسة',
            ],
        ])->save();
    }

    protected function seedCourses(): void
    {
        $featureSet = [
            ['icon' => 'book-open', 'label' => ['en' => 'Lectures', 'bn' => 'লেকচার', 'ar' => 'محاضرات'], 'value' => '20'],
            ['icon' => 'pencil', 'label' => ['en' => 'Quizes', 'bn' => 'কুইজ', 'ar' => 'اختبارات'], 'value' => '12'],
            ['icon' => 'globe', 'label' => ['en' => 'Language', 'bn' => 'ভাষা', 'ar' => 'اللغة'], 'value' => ['en' => 'English', 'bn' => 'ইংরেজি', 'ar' => 'الإنجليزية']],
            ['icon' => 'map-pin', 'label' => ['en' => 'Location', 'bn' => 'অবস্থান', 'ar' => 'الموقع'], 'value' => ['en' => 'On Campus', 'bn' => 'ক্যাম্পাসে', 'ar' => 'في الحرم الجامعي']],
            ['icon' => 'graduation-cap', 'label' => ['en' => 'Certificate', 'bn' => 'সার্টিফিকেট', 'ar' => 'شهادة'], 'value' => ['en' => 'Yes', 'bn' => 'হ্যাঁ', 'ar' => 'نعم']],
            ['icon' => 'circle-check', 'label' => ['en' => 'Assessments', 'bn' => 'মূল্যায়ন', 'ar' => 'تقييمات'], 'value' => ['en' => 'Yes', 'bn' => 'হ্যাঁ', 'ar' => 'نعم']],
        ];

        $requirements = [
            ['en' => 'A recognized secondary school certificate.', 'bn' => 'একটি স্বীকৃত মাধ্যমিক বিদ্যালয়ের সার্টিফিকেট।', 'ar' => 'شهادة مدرسة ثانوية معترف بها.'],
            ['en' => 'Basic proficiency in English.', 'bn' => 'ইংরেজিতে প্রাথমিক দক্ষতা।', 'ar' => 'إتقان أساسي للغة الإنجليزية.'],
            ['en' => 'A completed admission form and passport photo.', 'bn' => 'পূরণকৃত ভর্তি ফর্ম এবং পাসপোর্ট ছবি।', 'ar' => 'استمارة قبول مكتملة وصورة جواز سفر.'],
        ];

        $courses = [
            [
                'slug' => 'acting-and-drama',
                'title' => ['en' => 'Acting And Drama', 'bn' => 'অভিনয় ও নাটক', 'ar' => 'التمثيل والدراما'],
                'category' => ['en' => 'Drama', 'bn' => 'নাটক', 'ar' => 'دراما'],
                'thumbnail' => 'course/01.jpg',
                'lessons_count' => 10,
                'rating' => 4.0,
                'seats' => 75,
                'duration' => ['en' => '04 Years', 'bn' => '৪ বছর', 'ar' => '4 سنوات'],
                'price' => '$750',
                'instructor' => ['en' => 'Frank Mitchel', 'bn' => 'ফ্র্যাঙ্ক মিচেল', 'ar' => 'فرانك ميتشل'],
                'enrolled' => ['en' => '50 Students', 'bn' => '৫০ জন শিক্ষার্থী', 'ar' => '50 طالبًا'],
            ],
            [
                'slug' => 'art-and-design',
                'title' => ['en' => 'Art And Design', 'bn' => 'শিল্প ও নকশা', 'ar' => 'الفن والتصميم'],
                'category' => ['en' => 'Design', 'bn' => 'নকশা', 'ar' => 'تصميم'],
                'thumbnail' => 'course/02.jpg',
                'lessons_count' => 10,
                'rating' => 4.0,
                'seats' => 75,
                'duration' => ['en' => '04 Years', 'bn' => '৪ বছর', 'ar' => '4 سنوات'],
                'price' => '$750',
                'instructor' => ['en' => 'Angela Vigil', 'bn' => 'অ্যাঞ্জেলা ভিজিল', 'ar' => 'أنجيلا فيجيل'],
                'enrolled' => ['en' => '50 Students', 'bn' => '৫০ জন শিক্ষার্থী', 'ar' => '50 طالبًا'],
            ],
            [
                'slug' => 'biology-and-conservation',
                'title' => ['en' => 'Biology And Conservation', 'bn' => 'জীববিজ্ঞান ও সংরক্ষণ', 'ar' => 'الأحياء والحفاظ على البيئة'],
                'category' => ['en' => 'Science', 'bn' => 'বিজ্ঞান', 'ar' => 'علوم'],
                'thumbnail' => 'course/03.jpg',
                'lessons_count' => 10,
                'rating' => 4.0,
                'seats' => 75,
                'duration' => ['en' => '04 Years', 'bn' => '৪ বছর', 'ar' => '4 سنوات'],
                'price' => '$750',
                'instructor' => ['en' => 'Susan Lunsford', 'bn' => 'সুসান লান্সফোর্ড', 'ar' => 'سوزان لونسفورد'],
                'enrolled' => ['en' => '50 Students', 'bn' => '৫০ জন শিক্ষার্থী', 'ar' => '50 طالبًا'],
            ],
            [
                'slug' => 'science-and-engineering',
                'title' => ['en' => 'Science And Engineering', 'bn' => 'বিজ্ঞান ও প্রকৌশল', 'ar' => 'العلوم والهندسة'],
                'category' => ['en' => 'Science', 'bn' => 'বিজ্ঞান', 'ar' => 'علوم'],
                'thumbnail' => 'course/04.jpg',
                'lessons_count' => 10,
                'rating' => 4.0,
                'seats' => 75,
                'duration' => ['en' => '04 Years', 'bn' => '৪ বছর', 'ar' => '4 سنوات'],
                'price' => '$750',
                'instructor' => ['en' => 'Frank Mitchel', 'bn' => 'ফ্র্যাঙ্ক মিচেল', 'ar' => 'فرانك ميتشل'],
                'enrolled' => ['en' => '50 Students', 'bn' => '৫০ জন শিক্ষার্থী', 'ar' => '50 طالبًا'],
            ],
            [
                'slug' => 'health-administration',
                'title' => ['en' => 'Health Administration', 'bn' => 'স্বাস্থ্য প্রশাসন', 'ar' => 'إدارة الصحة'],
                'category' => ['en' => 'Health', 'bn' => 'স্বাস্থ্য', 'ar' => 'صحة'],
                'thumbnail' => 'course/05.jpg',
                'lessons_count' => 10,
                'rating' => 4.0,
                'seats' => 75,
                'duration' => ['en' => '04 Years', 'bn' => '৪ বছর', 'ar' => '4 سنوات'],
                'price' => '$750',
                'instructor' => ['en' => 'Angela Vigil', 'bn' => 'অ্যাঞ্জেলা ভিজিল', 'ar' => 'أنجيلا فيجيل'],
                'enrolled' => ['en' => '50 Students', 'bn' => '৫০ জন শিক্ষার্থী', 'ar' => '50 طالبًا'],
            ],
            [
                'slug' => 'accounting-and-finance',
                'title' => ['en' => 'Accounting And Finance', 'bn' => 'হিসাববিজ্ঞান ও অর্থায়ন', 'ar' => 'المحاسبة والتمويل'],
                'category' => ['en' => 'Finance', 'bn' => 'অর্থায়ন', 'ar' => 'تمويل'],
                'thumbnail' => 'course/06.jpg',
                'lessons_count' => 10,
                'rating' => 4.0,
                'seats' => 75,
                'duration' => ['en' => '04 Years', 'bn' => '৪ বছর', 'ar' => '4 سنوات'],
                'price' => '$750',
                'instructor' => ['en' => 'Susan Lunsford', 'bn' => 'সুসান লান্সফোর্ড', 'ar' => 'سوزان لونسفورد'],
                'enrolled' => ['en' => '50 Students', 'bn' => '৫০ জন শিক্ষার্থী', 'ar' => '50 طالبًا'],
            ],
        ];

        $teacherImage = $this->copyIntoStorage('course/teacher.jpg', 'site/courses-instructor.jpg');
        $galleryImage1 = $this->copyIntoStorage('course/01.jpg', 'site/courses-gallery-1.jpg');
        $galleryImage2 = $this->copyIntoStorage('course/02.jpg', 'site/courses-gallery-2.jpg');

        foreach ($courses as $index => $course) {
            $thumbnail = $this->copyIntoStorage($course['thumbnail'], "site/courses/{$course['slug']}.jpg");

            Course::updateOrCreate(
                ['slug' => $course['slug']],
                [
                    'title' => $course['title'],
                    'category' => $course['category'],
                    'thumbnail' => $thumbnail,
                    'short_description' => [
                        'en' => 'There are many variations of passages orem psum available but the majority have suffer alteration in some form by injected.',
                        'bn' => 'অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।',
                        'ar' => 'هناك العديد من الاختلافات في المقاطع المتاحة، لكن معظمها قد خضع لتعديلات.',
                    ],
                    'lessons_count' => $course['lessons_count'],
                    'rating' => $course['rating'],
                    'seats' => $course['seats'],
                    'duration' => $course['duration'],
                    'price' => $course['price'],
                    'description' => [
                        'en' => '<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness.</p>',
                        'bn' => '<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই কোর্সটি শিক্ষার্থীদের ব্যবহারিক ও তাত্ত্বিক জ্ঞান উভয়ই প্রদান করে।</p>',
                        'ar' => '<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>توفر هذه الدورة للطلاب المعرفة العملية والنظرية على حد سواء.</p>',
                    ],
                    'gallery_image_1' => $galleryImage1,
                    'gallery_image_2' => $galleryImage2,
                    'instructor_name' => $course['instructor'],
                    'instructor_image' => $teacherImage,
                    'enrolled_text' => $course['enrolled'],
                    'requirement_title' => ['en' => 'Course Requirement', 'bn' => 'কোর্সের প্রয়োজনীয়তা', 'ar' => 'متطلبات الدورة'],
                    'requirement_items' => collect($requirements)->map(fn ($text) => ['text' => $text])->all(),
                    'experience_title' => ['en' => 'Professional Experience', 'bn' => 'পেশাগত অভিজ্ঞতা', 'ar' => 'الخبرة المهنية'],
                    'experience_description' => [
                        'en' => 'Graduates of this program go on to internships and entry-level roles with our partner institutions, building real professional experience before they finish.',
                        'bn' => 'এই প্রোগ্রামের স্নাতকরা আমাদের অংশীদার প্রতিষ্ঠানে ইন্টার্নশিপ এবং এন্ট্রি-লেভেল ভূমিকায় যোগ দেয়।',
                        'ar' => 'يلتحق خريجو هذا البرنامج بالتدريب الداخلي والوظائف المبتدئة لدى مؤسساتنا الشريكة.',
                    ],
                    'features' => collect($featureSet)->map(fn ($feature) => [
                        'icon' => ['source' => 'lucide', 'value' => $feature['icon']],
                        'label' => $feature['label'],
                        'value' => is_array($feature['value']) ? $feature['value'] : ['en' => $feature['value'], 'bn' => $feature['value'], 'ar' => $feature['value']],
                    ])->all(),
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
