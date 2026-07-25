<?php

namespace Database\Seeders;

use App\Models\Notice;
use App\Models\NoticePageSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class NoticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedPageSettings();
        $this->seedNotices();
    }

    protected function seedPageSettings(): void
    {
        $breadcrumbImage = $this->copyIntoStorage('breadcrumb/01.jpg', 'site/notices-breadcrumb.jpg');
        $settings = NoticePageSetting::query()->first() ?? new NoticePageSetting();

        $settings->fill([
            'marquee_label' => ['en' => 'Notice', 'bn' => 'বিজ্ঞপ্তি', 'ar' => 'إشعار'],
            'breadcrumb_title' => ['en' => 'Notice', 'bn' => 'বিজ্ঞপ্তি', 'ar' => 'إشعار'],
            'breadcrumb_image' => $breadcrumbImage ?? $settings->breadcrumb_image,
            'seo_title' => ['en' => 'Notice', 'bn' => 'বিজ্ঞপ্তি', 'ar' => 'إشعار'],
            'seo_description' => [
                'en' => 'Read the latest notices, routines, and announcements from our school.',
                'bn' => 'আমাদের স্কুলের সর্বশেষ বিজ্ঞপ্তি, রুটিন এবং ঘোষণা পড়ুন।',
                'ar' => 'اقرأ أحدث الإشعارات والجداول والإعلانات من مدرستنا.',
            ],
            'seo_keywords' => [
                'en' => 'notice, announcements, school notice board',
                'bn' => 'বিজ্ঞপ্তি, ঘোষণা, স্কুল নোটিশ বোর্ড',
                'ar' => 'إشعار، إعلانات، لوحة إعلانات المدرسة',
            ],
        ])->save();
    }

    protected function seedNotices(): void
    {
        $notices = [
            [
                'slug' => 'mid-term-examination-routine-2026',
                'title' => ['en' => 'Mid-Term Examination Routine 2026', 'bn' => 'মধ্যবর্তী পরীক্ষার রুটিন ২০২৬', 'ar' => 'جدول امتحانات منتصف الفصل الدراسي 2026'],
                'date' => '2026-07-10',
            ],
            [
                'slug' => 'annual-sports-day-notice',
                'title' => ['en' => 'Annual Sports Day Notice', 'bn' => 'বার্ষিক ক্রীড়া দিবস বিজ্ঞপ্তি', 'ar' => 'إشعار يوم الرياضة السنوي'],
                'date' => '2026-06-28',
            ],
            [
                'slug' => 'summer-vacation-notice',
                'title' => ['en' => 'Summer Vacation Notice', 'bn' => 'গ্রীষ্মকালীন ছুটির বিজ্ঞপ্তি', 'ar' => 'إشعار العطلة الصيفية'],
                'date' => '2026-06-15',
            ],
            [
                'slug' => 'admission-test-result-publication',
                'title' => ['en' => 'Admission Test Result Publication', 'bn' => 'ভর্তি পরীক্ষার ফলাফল প্রকাশ', 'ar' => 'نشر نتائج اختبار القبول'],
                'date' => '2026-06-02',
            ],
            [
                'slug' => 'parents-teacher-meeting-schedule',
                'title' => ['en' => 'Parents-Teacher Meeting Schedule', 'bn' => 'অভিভাবক-শিক্ষক সভার সময়সূচি', 'ar' => 'جدول اجتماع أولياء الأمور والمعلمين'],
                'date' => '2026-05-20',
            ],
            [
                'slug' => 'half-yearly-exam-result-notice',
                'title' => ['en' => 'Half-Yearly Exam Result Notice', 'bn' => 'অর্ধ-বার্ষিক পরীক্ষার ফলাফল বিজ্ঞপ্তি', 'ar' => 'إشعار نتائج الامتحان نصف السنوي'],
                'date' => '2026-05-05',
            ],
        ];

        foreach ($notices as $notice) {
            $pdfPath = "site/notices/{$notice['slug']}.pdf";

            if (! Storage::disk('public')->exists($pdfPath)) {
                Storage::disk('public')->put($pdfPath, $this->generatePdf($notice['title']['en']));
            }

            Notice::updateOrCreate(
                ['slug' => $notice['slug']],
                [
                    'title' => $notice['title'],
                    'description' => [
                        'en' => '<p>Please be informed of the details regarding this notice. All concerned students, parents, and staff are requested to take note of the schedule and requirements mentioned above.</p><p>For any queries, please contact the school office during working hours.</p>',
                        'bn' => '<p>এই বিজ্ঞপ্তি সম্পর্কিত বিস্তারিত জানতে অনুরোধ করা হচ্ছে। সকল সংশ্লিষ্ট শিক্ষার্থী, অভিভাবক এবং কর্মীদের উপরে উল্লিখিত সময়সূচি ও প্রয়োজনীয়তা লক্ষ্য করার অনুরোধ করা হলো।</p><p>যেকোনো জিজ্ঞাসার জন্য, অনুগ্রহ করে কর্মঘণ্টার মধ্যে স্কুল অফিসে যোগাযোগ করুন।</p>',
                        'ar' => '<p>يرجى الاطلاع على التفاصيل المتعلقة بهذا الإشعار. يُرجى من جميع الطلاب وأولياء الأمور والموظفين المعنيين مراعاة الجدول والمتطلبات المذكورة أعلاه.</p><p>لأي استفسارات، يرجى الاتصال بمكتب المدرسة خلال ساعات العمل.</p>',
                    ],
                    'pdf' => $pdfPath,
                    'published_at' => $notice['date'],
                    'is_active' => true,
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

    /**
     * There's no sample PDF asset shipped with the theme to copy, so build a
     * minimal one-page valid PDF (title only) to attach to each seeded
     * notice — enough for the download button to be real and clickable.
     */
    protected function generatePdf(string $title): string
    {
        $text = addcslashes($title, '()\\');
        $stream = "BT /F1 18 Tf 50 750 Td ({$text}) Tj ET";

        $objects = [];
        $objects[1] = "<< /Type /Catalog /Pages 2 0 R >>";
        $objects[2] = "<< /Type /Pages /Kids [3 0 R] /Count 1 >>";
        $objects[3] = "<< /Type /Page /Parent 2 0 R /MediaBox [0 0 612 792] /Resources << /Font << /F1 4 0 R >> >> /Contents 5 0 R >>";
        $objects[4] = "<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>";
        $objects[5] = "<< /Length ".strlen($stream)." >>\nstream\n{$stream}\nendstream";

        $pdf = "%PDF-1.4\n";
        $offsets = [];

        foreach ($objects as $number => $body) {
            $offsets[$number] = strlen($pdf);
            $pdf .= "{$number} 0 obj\n{$body}\nendobj\n";
        }

        $xrefOffset = strlen($pdf);
        $pdf .= "xref\n0 ".(count($objects) + 1)."\n";
        $pdf .= "0000000000 65535 f \n";
        foreach ($offsets as $offset) {
            $pdf .= str_pad((string) $offset, 10, '0', STR_PAD_LEFT)." 00000 n \n";
        }

        $pdf .= "trailer\n<< /Size ".(count($objects) + 1)." /Root 1 0 R >>\nstartxref\n{$xrefOffset}\n%%EOF";

        return $pdf;
    }
}
