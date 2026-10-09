<?php

namespace Database\Seeders;

use App\Models\Donor;
use App\Models\Founder;
use App\Models\FounderDonorPageSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class FounderDonorSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Founder::truncate();
        Donor::truncate();
        FounderDonorPageSetting::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->seedPageSettings();
        $this->seedFounders();
        $this->seedDonors();
    }

    protected function seedPageSettings(): void
    {
        $breadcrumbImage = $this->copyIntoStorage('breadcrumb/01.jpg', 'site/founders-donors-breadcrumb.jpg');
        $settings = new FounderDonorPageSetting();

        $settings->fill([
            'section_tagline' => ['en' => 'Our Contributors', 'bn' => 'আমাদের অবদানকারী'],
            'section_title' => ['en' => 'Founder & Donor List', 'bn' => 'প্রতিষ্ঠাতা ও দাতাদের তালিকা'],
            'section_highlight' => ['en' => 'Donor', 'bn' => 'দাতা'],
            'section_description' => [
                'en' => 'We gratefully acknowledge the founding members and generous donors whose vision and support made the growth of EduEx School and College possible.',
                'bn' => 'যাদের দূরদর্শিতা ও উদার সহযোগিতায় এডুএক্স স্কুল এন্ড কলেজের বিকাশ সম্ভব হয়েছে, আমরা কৃতজ্ঞতার সাথে সেই প্রতিষ্ঠাতা সদস্য ও দাতাদের স্মরণ করছি।',
            ],
            'founders_table_title' => ['en' => 'Founding Members', 'bn' => 'প্রতিষ্ঠাতা সদস্যবৃন্দ'],
            'donors_table_title' => ['en' => 'Honorable Donors', 'bn' => 'সম্মানিত দাতাবৃন্দ'],
            'breadcrumb_title' => ['en' => 'Founder & Donor List', 'bn' => 'প্রতিষ্ঠাতা ও দাতাদের তালিকা'],
            'breadcrumb_image' => $breadcrumbImage ?? null,
            'seo_title' => ['en' => 'Founder & Donor List | EduEx School and College', 'bn' => 'প্রতিষ্ঠাতা ও দাতাদের তালিকা | এডুএক্স স্কুল এন্ড কলেজ'],
            'seo_description' => ['en' => 'Meet the founding members and generous donors who made this institution possible.', 'bn' => 'এই প্রতিষ্ঠানটি প্রতিষ্ঠা করতে সাহায্যকারী প্রতিষ্ঠাতা ও দাতাদের সাথে পরিচিত হোন।'],
            'seo_keywords' => ['en' => 'founders, donors, contributors, eduex', 'bn' => 'প্রতিষ্ঠাতা, দাতা, অবদানকারী, এডুএক্স'],
        ])->save();
    }

    protected function seedFounders(): void
    {
        $founders = [
            ['name' => ['en' => 'Dr. Kazi Nurul Islam', 'bn' => 'ড. কাজী নুরুল ইসলাম'], 'designation' => ['en' => 'Founder & Chairman', 'bn' => 'প্রতিষ্ঠাতা ও চেয়ারম্যান'], 'year' => '1995'],
            ['name' => ['en' => 'Professor Abdur Rahman', 'bn' => 'অধ্যাপক আবদুর রহমান'], 'designation' => ['en' => 'Co-Founder', 'bn' => 'সহ-প্রতিষ্ঠাতা'], 'year' => '1995'],
            ['name' => ['en' => 'Mr. Sirajul Haque', 'bn' => 'জনাব সিরাজুল হক'], 'designation' => ['en' => 'Founding Secretary', 'bn' => 'প্রতিষ্ঠাতা সম্পাদক'], 'year' => '1995'],
            ['name' => ['en' => 'Mrs. Rokeya Begum', 'bn' => 'বেগম রোকেয়া বেগম'], 'designation' => ['en' => 'Founding Member', 'bn' => 'প্রতিষ্ঠাতা সদস্য'], 'year' => '1995'],
        ];

        foreach ($founders as $index => $founder) {
            Founder::create([
                'name' => $founder['name'],
                'designation' => $founder['designation'],
                'year' => $founder['year'],
                'is_active' => true,
                'sort_order' => $index + 1,
            ]);
        }
    }

    protected function seedDonors(): void
    {
        $donors = [
            ['name' => ['en' => 'Al-Haj Anwar Hossain', 'bn' => 'আলহাজ্ব আনোয়ার হোসেন'], 'contribution' => ['en' => 'Chief Patron', 'bn' => 'প্রধান পৃষ্ঠপোষক'], 'year' => '2005'],
            ['name' => ['en' => 'Bashundhara Group', 'bn' => 'বসুন্ধরা গ্রুপ'], 'contribution' => ['en' => 'Corporate Sponsor', 'bn' => 'কর্পোরেট স্পনসর'], 'year' => '2010'],
            ['name' => ['en' => 'Mr. Jamal Uddin', 'bn' => 'জনাব জামাল উদ্দিন'], 'contribution' => ['en' => 'Well-wisher', 'bn' => 'শুভাকাঙ্ক্ষী'], 'year' => '2015'],
        ];

        foreach ($donors as $index => $donor) {
            Donor::create([
                'name' => $donor['name'],
                'contribution' => $donor['contribution'],
                'year' => $donor['year'],
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
