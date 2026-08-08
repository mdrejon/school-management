<?php

namespace Database\Seeders;

use App\Models\Donor;
use App\Models\Founder;
use App\Models\FounderDonorPageSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class FounderDonorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedPageSettings();
        $this->seedFounders();
        $this->seedDonors();
    }

    protected function seedPageSettings(): void
    {
        $breadcrumbImage = $this->copyIntoStorage('breadcrumb/01.jpg', 'site/founders-donors-breadcrumb.jpg');
        $settings = FounderDonorPageSetting::query()->first() ?? new FounderDonorPageSetting();

        $settings->fill([
            'section_tagline' => ['en' => 'Our Contributors', 'bn' => 'আমাদের অবদানকারী'],
            'section_title' => ['en' => 'Founder & Donor List', 'bn' => 'প্রতিষ্ঠাতা ও দাতাদের তালিকা'],
            'section_highlight' => ['en' => 'Donor', 'bn' => 'দাতা'],
            'section_description' => [
                'en' => 'We gratefully acknowledge the founding members and generous donors whose vision and support made the growth of this institution possible.',
                'bn' => 'যাদের দূরদর্শিতা ও উদার সহযোগিতায় এই প্রতিষ্ঠানের বিকাশ সম্ভব হয়েছে, আমরা কৃতজ্ঞতার সাথে সেই প্রতিষ্ঠাতা সদস্য ও দাতাদের স্মরণ করছি।',
            ],
            'founders_table_title' => ['en' => 'Founding Members', 'bn' => 'প্রতিষ্ঠাতা সদস্যবৃন্দ'],
            'donors_table_title' => ['en' => 'Honorable Donors', 'bn' => 'সম্মানিত দাতাবৃন্দ'],
            'breadcrumb_title' => ['en' => 'Founder & Donor List', 'bn' => 'প্রতিষ্ঠাতা ও দাতাদের তালিকা'],
            'breadcrumb_image' => $breadcrumbImage ?? $settings->breadcrumb_image,
            'seo_title' => ['en' => 'Founder & Donor List'],
            'seo_description' => ['en' => 'Meet the founding members and generous donors who made this institution possible.'],
            'seo_keywords' => ['en' => 'founders, donors, contributors'],
        ])->save();
    }

    protected function seedFounders(): void
    {
        $founders = [
            ['name' => 'Md. Abdul Karim', 'designation' => 'Founder & Chairman', 'year' => '1918'],
            ['name' => 'Abdur Rahman Talukder', 'designation' => 'Co-Founder', 'year' => '1918'],
            ['name' => 'Kazi Nurul Islam', 'designation' => 'Founding Secretary', 'year' => '1918'],
            ['name' => 'Md. Sirajul Haque', 'designation' => 'Founding Member', 'year' => '1918'],
        ];

        foreach ($founders as $index => $founder) {
            $existing = Founder::whereJsonContains('name->en', $founder['name'])->first();

            if ($existing) {
                continue;
            }

            Founder::create([
                'name' => ['en' => $founder['name']],
                'designation' => ['en' => $founder['designation']],
                'year' => $founder['year'],
                'is_active' => true,
                'sort_order' => $index + 1,
            ]);
        }
    }

    protected function seedDonors(): void
    {
        $donors = [
            ['name' => 'Haji Motiur Rahman', 'contribution' => 'Land Donation', 'year' => '1925'],
            ['name' => 'Amina Khatun Trust', 'contribution' => 'Library Building', 'year' => '1962'],
            ['name' => 'Md. Ismail Hossain', 'contribution' => 'Science Lab Equipment', 'year' => '1988'],
            ['name' => 'Sultana Begum Foundation', 'contribution' => 'Scholarship Fund', 'year' => '2005'],
            ['name' => 'Anwarul Azim', 'contribution' => 'Auditorium Construction', 'year' => '2012'],
        ];

        foreach ($donors as $index => $donor) {
            $existing = Donor::whereJsonContains('name->en', $donor['name'])->first();

            if ($existing) {
                continue;
            }

            Donor::create([
                'name' => ['en' => $donor['name']],
                'contribution' => ['en' => $donor['contribution']],
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
