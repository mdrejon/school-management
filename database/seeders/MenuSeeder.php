<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Carries the existing static header nav (resources/views/frontend/
     * layouts/app.blade.php, before it became admin-editable) into the new
     * Menu/MenuItem tables verbatim — every item as a plain 'custom' link
     * with its current literal href, not upgraded to a 'route'/'model'
     * link. Nothing about the rendered menu changes; it's just editable
     * now. The admin can repoint any of these at a real page afterward.
     * Labels are seeded in all three active languages (EN/BN/AR), same as
     * every other seeder — not just the default locale.
     */
    public function run(): void
    {
        $menu = Menu::firstOrCreate(['slug' => 'header'], ['name' => 'Main Menu']);

        if ($menu->items()->exists()) {
            return;
        }

        $tree = [
            ['label' => ['en' => 'Home', 'bn' => 'হোম', 'ar' => 'الرئيسية'], 'url' => '/'],
            ['label' => ['en' => 'About', 'bn' => 'সম্পর্কে', 'ar' => 'حول'], 'url' => '#', 'children' => [
                ['label' => ['en' => 'About Us', 'bn' => 'আমাদের সম্পর্কে', 'ar' => 'من نحن'], 'url' => 'about.html'],
                ['label' => ['en' => 'History', 'bn' => 'ইতিহাস', 'ar' => 'التاريخ'], 'url' => 'history.html'],
                ['label' => ['en' => 'Founder & Doner List', 'bn' => 'প্রতিষ্ঠাতা ও দাতা তালিকা', 'ar' => 'قائمة المؤسسين والمتبرعين'], 'url' => 'donor-list.html'],
                ['label' => ['en' => 'Our Vision', 'bn' => 'আমাদের লক্ষ্য', 'ar' => 'رؤيتنا'], 'url' => 'mission-vision.html'],
                ['label' => ['en' => 'Campus Tour', 'bn' => 'ক্যাম্পাস ভ্রমণ', 'ar' => 'جولة الحرم الجامعي'], 'url' => 'campus-tour.html'],
                ['label' => ['en' => 'Achievements', 'bn' => 'অর্জনসমূহ', 'ar' => 'الإنجازات'], 'url' => 'achievements.html'],
                ['label' => ['en' => 'Honorable Chairman', 'bn' => 'সম্মানিত চেয়ারম্যান', 'ar' => 'الرئيس الموقر'], 'url' => 'chairman-speech.html'],
                ['label' => ['en' => 'Governing Body', 'bn' => 'পরিচালনা পর্ষদ', 'ar' => 'مجلس الإدارة'], 'url' => 'governing-body.html'],
                ['label' => ['en' => 'EX Governing Body', 'bn' => 'সাবেক পরিচালনা পর্ষদ', 'ar' => 'مجلس الإدارة السابق'], 'url' => 'ex-governing-body.html'],
                ['label' => ['en' => 'Our Principal', 'bn' => 'আমাদের অধ্যক্ষ', 'ar' => 'مديرنا'], 'url' => 'principal-speech.html'],
                ['label' => ['en' => 'Our EX Principal', 'bn' => 'আমাদের সাবেক অধ্যক্ষ', 'ar' => 'مديرنا السابق'], 'url' => 'ex-principals.html'],
                ['label' => ['en' => 'Administrators', 'bn' => 'প্রশাসকবৃন্দ', 'ar' => 'الإداريون'], 'url' => 'administrators.html'],
            ]],
            ['label' => ['en' => 'Information', 'bn' => 'তথ্য', 'ar' => 'معلومات'], 'url' => '#', 'children' => [
                ['label' => ['en' => 'Teaching Permission & Recognition Letter', 'bn' => 'শিক্ষাদান অনুমতি ও স্বীকৃতি পত্র', 'ar' => 'خطاب إذن واعتراف التدريس'], 'url' => 'permission-recognition-letter.html'],
                ['label' => ['en' => 'Nationalization', 'bn' => 'জাতীয়করণ', 'ar' => 'التأميم'], 'url' => 'nationalization.html'],
                ['label' => ['en' => 'Statistics Report', 'bn' => 'পরিসংখ্যান প্রতিবেদন', 'ar' => 'تقرير الإحصائيات'], 'url' => 'statistics-report.html'],
                ['label' => ['en' => 'Govt. Approval Letter', 'bn' => 'সরকারি অনুমোদন পত্র', 'ar' => 'خطاب الموافقة الحكومية'], 'url' => 'govt-approval-letter.html'],
            ]],
            ['label' => ['en' => 'Academic', 'bn' => 'একাডেমিক', 'ar' => 'أكاديمي'], 'url' => '#', 'children' => [
                ['label' => ['en' => 'Class Schedule', 'bn' => 'ক্লাস সময়সূচি', 'ar' => 'الجدول الدراسي'], 'url' => 'class-schedule.html'],
                ['label' => ['en' => 'Our Teachers', 'bn' => 'আমাদের শিক্ষকবৃন্দ', 'ar' => 'معلمونا'], 'url' => 'teacher.html'],
                ['label' => ['en' => 'Former Teachers', 'bn' => 'প্রাক্তন শিক্ষকবৃন্দ', 'ar' => 'المعلمون السابقون'], 'url' => 'former-teachers.html'],
                ['label' => ['en' => 'Our Staffs', 'bn' => 'আমাদের কর্মীবৃন্দ', 'ar' => 'موظفونا'], 'url' => 'staffs.html'],
                ['label' => ['en' => 'Former Staffs', 'bn' => 'প্রাক্তন কর্মীবৃন্দ', 'ar' => 'الموظفون السابقون'], 'url' => 'former-staffs.html'],
                ['label' => ['en' => 'Academic Rules', 'bn' => 'একাডেমিক নিয়মাবলী', 'ar' => 'القواعد الأكاديمية'], 'url' => 'academic-rules.html'],
                ['label' => ['en' => 'Academic Calendar', 'bn' => 'একাডেমিক ক্যালেন্ডার', 'ar' => 'التقويم الأكاديمي'], 'url' => 'academic-calendar.html'],
                ['label' => ['en' => 'Attendance Sheet', 'bn' => 'উপস্থিতি শীট', 'ar' => 'ورقة الحضور'], 'url' => 'attendance-sheet.html'],
                ['label' => ['en' => 'Leave Information', 'bn' => 'ছুটির তথ্য', 'ar' => 'معلومات الإجازة'], 'url' => '#'],
            ]],
            ['label' => ['en' => 'Admission', 'bn' => 'ভর্তি', 'ar' => 'القبول'], 'url' => '#', 'children' => [
                ['label' => ['en' => 'Why Study ?', 'bn' => 'কেন পড়বেন?', 'ar' => 'لماذا الدراسة؟'], 'url' => 'why-study.html'],
                ['label' => ['en' => 'How to apply', 'bn' => 'কীভাবে আবেদন করবেন', 'ar' => 'كيفية التقديم'], 'url' => 'how-to-apply.html'],
                ['label' => ['en' => 'Admission Test', 'bn' => 'ভর্তি পরীক্ষা', 'ar' => 'اختبار القبول'], 'url' => 'admission-test.html'],
                ['label' => ['en' => 'Admission Policy', 'bn' => 'ভর্তি নীতি', 'ar' => 'سياسة القبول'], 'url' => 'admission-policy.html'],
                ['label' => ['en' => 'Registration System', 'bn' => 'নিবন্ধন পদ্ধতি', 'ar' => 'نظام التسجيل'], 'url' => 'registration-system.html'],
            ]],
            ['label' => ['en' => 'Student', 'bn' => 'শিক্ষার্থী', 'ar' => 'الطالب'], 'url' => '#', 'children' => [
                ['label' => ['en' => 'Student List', 'bn' => 'শিক্ষার্থী তালিকা', 'ar' => 'قائمة الطلاب'], 'url' => 'student-list.html'],
                ['label' => ['en' => 'Tution Fees', 'bn' => 'টিউশন ফি', 'ar' => 'الرسوم الدراسية'], 'url' => 'tuition-fee.html'],
                ['label' => ['en' => 'Mobile Banking', 'bn' => 'মোবাইল ব্যাংকিং', 'ar' => 'الخدمات المصرفية عبر الهاتف المحمول'], 'url' => 'mobile-banking.html'],
                ['label' => ['en' => 'Daily Activities', 'bn' => 'দৈনন্দিন কার্যক্রম', 'ar' => 'الأنشطة اليومية'], 'url' => 'daily-activities.html'],
                ['label' => ['en' => 'Exam Schedule', 'bn' => 'পরীক্ষার সময়সূচি', 'ar' => 'جدول الامتحانات'], 'url' => 'exam-schedule.html'],
                ['label' => ['en' => 'Student Uniform', 'bn' => 'শিক্ষার্থী ইউনিফর্ম', 'ar' => 'زي الطلاب'], 'url' => 'student-uniform.html'],
                ['label' => ['en' => 'Exam System', 'bn' => 'পরীক্ষা পদ্ধতি', 'ar' => 'نظام الامتحان'], 'url' => 'exam-system.html'],
                ['label' => ['en' => 'Rules and Regulation', 'bn' => 'নিয়ম ও প্রবিধান', 'ar' => 'القواعد واللوائح'], 'url' => 'rules-regulation.html'],
            ]],
            ['label' => ['en' => 'Facilities', 'bn' => 'সুযোগ-সুবিধা', 'ar' => 'المرافق'], 'url' => '#', 'children' => [
                ['label' => ['en' => 'Library', 'bn' => 'গ্রন্থাগার', 'ar' => 'المكتبة'], 'url' => 'library.html'],
                ['label' => ['en' => 'Play Ground', 'bn' => 'খেলার মাঠ', 'ar' => 'الملعب'], 'url' => 'play-ground.html'],
                ['label' => ['en' => 'Physics Lab', 'bn' => 'পদার্থবিজ্ঞান ল্যাব', 'ar' => 'مختبر الفيزياء'], 'url' => 'physics-lab.html'],
                ['label' => ['en' => 'Biology Lab', 'bn' => 'জীববিজ্ঞান ল্যাব', 'ar' => 'مختبر الأحياء'], 'url' => 'biology-lab.html'],
                ['label' => ['en' => 'ICT Lab', 'bn' => 'আইসিটি ল্যাব', 'ar' => 'مختبر تقنية المعلومات'], 'url' => 'ict-lab.html'],
                ['label' => ['en' => 'Chemistry Lab', 'bn' => 'রসায়ন ল্যাব', 'ar' => 'مختبر الكيمياء'], 'url' => 'chemistry-lab.html'],
                ['label' => ['en' => 'Extra Activities', 'bn' => 'অতিরিক্ত কার্যক্রম', 'ar' => 'الأنشطة الإضافية'], 'url' => 'extra-activities.html'],
            ]],
            ['label' => ['en' => 'Result', 'bn' => 'ফলাফল', 'ar' => 'النتيجة'], 'url' => '#', 'children' => [
                ['label' => ['en' => 'Exam Result', 'bn' => 'পরীক্ষার ফলাফল', 'ar' => 'نتيجة الامتحان'], 'url' => 'result.html'],
                ['label' => ['en' => 'Academic Result', 'bn' => 'একাডেমিক ফলাফল', 'ar' => 'النتيجة الأكاديمية'], 'url' => 'search-result.html'],
                ['label' => ['en' => 'Evaluation Result', 'bn' => 'মূল্যায়ন ফলাফল', 'ar' => 'نتيجة التقييم'], 'url' => 'evaluation-result.html'],
                ['label' => ['en' => 'Board Exam Result', 'bn' => 'বোর্ড পরীক্ষার ফলাফল', 'ar' => 'نتيجة امتحان المجلس'], 'url' => 'board-exam-result.html'],
            ]],
            ['label' => ['en' => 'Others', 'bn' => 'অন্যান্য', 'ar' => 'أخرى'], 'url' => '#', 'children' => [
                ['label' => ['en' => 'Notice', 'bn' => 'বিজ্ঞপ্তি', 'ar' => 'إشعار'], 'url' => 'notice.html'],
                ['label' => ['en' => 'News', 'bn' => 'সংবাদ', 'ar' => 'أخبار'], 'url' => 'news.html'],
                ['label' => ['en' => 'Gallery', 'bn' => 'গ্যালারি', 'ar' => 'معرض الصور'], 'url' => 'gallery.html'],
                ['label' => ['en' => 'Event', 'bn' => 'অনুষ্ঠান', 'ar' => 'الفعالية'], 'url' => 'event.html'],
                ['label' => ['en' => 'Routine', 'bn' => 'রুটিন', 'ar' => 'الجدول'], 'url' => 'routine.html'],
                ['label' => ['en' => 'Download', 'bn' => 'ডাউনলোড', 'ar' => 'تحميل'], 'url' => 'download.html'],
            ]],
            ['label' => ['en' => 'Pages', 'bn' => 'পৃষ্ঠাসমূহ', 'ar' => 'الصفحات'], 'url' => '#', 'children' => [
                ['label' => ['en' => 'Courses', 'bn' => 'কোর্সসমূহ', 'ar' => 'الدورات'], 'url' => 'course.html'],
                ['label' => ['en' => 'Course Single', 'bn' => 'একক কোর্স', 'ar' => 'دورة فردية'], 'url' => 'course-single.html'],
                ['label' => ['en' => 'Academic', 'bn' => 'একাডেমিক', 'ar' => 'أكاديمي'], 'url' => 'academic.html'],
                ['label' => ['en' => 'Academic Single', 'bn' => 'একক একাডেমিক', 'ar' => 'أكاديمي فردي'], 'url' => 'academic-single.html'],
                ['label' => ['en' => 'Facility', 'bn' => 'সুবিধা', 'ar' => 'مرفق'], 'url' => 'facility.html'],
                ['label' => ['en' => 'Teacher Single', 'bn' => 'একক শিক্ষক', 'ar' => 'معلم فردي'], 'url' => 'teacher-single.html'],
                ['label' => ['en' => 'Event Single', 'bn' => 'একক অনুষ্ঠান', 'ar' => 'فعالية فردية'], 'url' => 'event-single.html'],
                ['label' => ['en' => 'Portfolio', 'bn' => 'পোর্টফোলিও', 'ar' => 'ملف الأعمال'], 'url' => 'portfolio.html'],
                ['label' => ['en' => 'Portfolio Single', 'bn' => 'একক পোর্টফোলিও', 'ar' => 'ملف أعمال فردي'], 'url' => 'portfolio-single.html'],
                ['label' => ['en' => 'Blog', 'bn' => 'ব্লগ', 'ar' => 'المدونة'], 'url' => 'blog.html'],
                ['label' => ['en' => 'Blog Single', 'bn' => 'একক ব্লগ', 'ar' => 'مدونة فردية'], 'url' => 'blog-single.html'],
                ['label' => ['en' => 'Application Form', 'bn' => 'আবেদন ফর্ম', 'ar' => 'استمارة الطلب'], 'url' => 'application-form.html'],
                ['label' => ['en' => 'Pricing Plan', 'bn' => 'মূল্য পরিকল্পনা', 'ar' => 'خطة الأسعار'], 'url' => 'pricing.html'],
                ['label' => ['en' => 'Testimonials', 'bn' => 'প্রশংসাপত্র', 'ar' => 'الشهادات'], 'url' => 'testimonial.html'],
                ['label' => ['en' => 'Faq', 'bn' => 'সাধারণ জিজ্ঞাসা', 'ar' => 'الأسئلة الشائعة'], 'url' => 'faq.html'],
                ['label' => ['en' => 'Login', 'bn' => 'লগইন', 'ar' => 'تسجيل الدخول'], 'url' => 'login.html'],
                ['label' => ['en' => 'Register', 'bn' => 'নিবন্ধন করুন', 'ar' => 'التسجيل'], 'url' => 'register.html'],
                ['label' => ['en' => 'Terms Of Service', 'bn' => 'সেবার শর্তাবলী', 'ar' => 'شروط الخدمة'], 'url' => 'terms.html'],
                ['label' => ['en' => 'Privacy Policy', 'bn' => 'গোপনীয়তা নীতি', 'ar' => 'سياسة الخصوصية'], 'url' => 'privacy.html'],
                ['label' => ['en' => '404 Error', 'bn' => '৪০৪ ত্রুটি', 'ar' => 'خطأ 404'], 'url' => '404.html'],
            ]],
            ['label' => ['en' => 'Contact', 'bn' => 'যোগাযোগ', 'ar' => 'اتصل بنا'], 'url' => '#'],
        ];

        $this->insert($menu, $tree, null);
    }

    protected function insert(Menu $menu, array $nodes, ?int $parentId): void
    {
        foreach ($nodes as $index => $node) {
            $item = MenuItem::create([
                'menu_id' => $menu->id,
                'parent_id' => $parentId,
                'type' => 'custom',
                'label' => $node['label'],
                'url' => $node['url'],
                'target' => '_self',
                'sort_order' => $index + 1,
                'is_active' => true,
            ]);

            if (! empty($node['children'])) {
                $this->insert($menu, $node['children'], $item->id);
            }
        }
    }
}
