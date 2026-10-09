<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Campus;
use App\Models\EducationLevel;
use App\Models\EducationClass;
use App\Models\EducationLevelPageSetting;
use Illuminate\Support\Facades\DB;

class EducationLevelSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks to truncate safely
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Campus::truncate();
        EducationLevel::truncate();
        EducationClass::truncate();
        EducationLevelPageSetting::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $mainCampus = Campus::create([
            'name' => [
                'en' => 'Main Campus',
                'bn' => 'প্রধান ক্যাম্পাস'
            ],
            'sort_order' => 1
        ]);
        
        $primary = EducationLevel::create([
            'campus_id' => $mainCampus->id,
            'name' => [
                'en' => 'Primary Level',
                'bn' => 'প্রাথমিক স্তর'
            ],
            'description' => [
                'en' => 'Provides foundational education from Class 1 to Class 5.',
                'bn' => 'প্রথম থেকে পঞ্চম শ্রেণি পর্যন্ত মৌলিক শিক্ষা প্রদান করে।'
            ],
            'sort_order' => 1,
        ]);
        EducationClass::create(['education_level_id' => $primary->id, 'name' => ['en' => 'Class 1', 'bn' => 'প্রথম শ্রেণি'], 'sort_order' => 1]);
        EducationClass::create(['education_level_id' => $primary->id, 'name' => ['en' => 'Class 2', 'bn' => 'দ্বিতীয় শ্রেণি'], 'sort_order' => 2]);
        EducationClass::create(['education_level_id' => $primary->id, 'name' => ['en' => 'Class 3', 'bn' => 'তৃতীয় শ্রেণি'], 'sort_order' => 3]);
        EducationClass::create(['education_level_id' => $primary->id, 'name' => ['en' => 'Class 4', 'bn' => 'চতুর্থ শ্রেণি'], 'sort_order' => 4]);
        EducationClass::create(['education_level_id' => $primary->id, 'name' => ['en' => 'Class 5', 'bn' => 'পঞ্চম শ্রেণি'], 'sort_order' => 5]);

        $secondary = EducationLevel::create([
            'campus_id' => $mainCampus->id,
            'name' => [
                'en' => 'Secondary Level (SSC)',
                'bn' => 'মাধ্যমিক স্তর (এসএসসি)'
            ],
            'description' => [
                'en' => 'Comprehensive education for junior and secondary students.',
                'bn' => 'জুনিয়র এবং মাধ্যমিক স্তরের শিক্ষার্থীদের জন্য ব্যাপক শিক্ষা।'
            ],
            'sort_order' => 2,
        ]);
        EducationClass::create(['education_level_id' => $secondary->id, 'name' => ['en' => 'Class 6', 'bn' => 'ষষ্ঠ শ্রেণি'], 'sort_order' => 1]);
        EducationClass::create(['education_level_id' => $secondary->id, 'name' => ['en' => 'Class 7', 'bn' => 'সপ্তম শ্রেণি'], 'sort_order' => 2]);
        EducationClass::create(['education_level_id' => $secondary->id, 'name' => ['en' => 'Class 8', 'bn' => 'অষ্টম শ্রেণি'], 'sort_order' => 3]);
        EducationClass::create(['education_level_id' => $secondary->id, 'name' => ['en' => 'Class 9', 'bn' => 'নবম শ্রেণি'], 'sort_order' => 4]);
        EducationClass::create(['education_level_id' => $secondary->id, 'name' => ['en' => 'Class 10', 'bn' => 'দশম শ্রেণি'], 'sort_order' => 5]);

        $higherSecondary = EducationLevel::create([
            'campus_id' => $mainCampus->id,
            'name' => [
                'en' => 'Higher Secondary (HSC)',
                'bn' => 'উচ্চ মাধ্যমিক স্তর (এইচএসসি)'
            ],
            'description' => [
                'en' => 'Advanced studies in Science, Business, and Humanities.',
                'bn' => 'বিজ্ঞান, বাণিজ্য এবং মানবিক বিভাগে উন্নত পড়াশোনা।'
            ],
            'sort_order' => 3,
        ]);
        EducationClass::create(['education_level_id' => $higherSecondary->id, 'name' => ['en' => 'Class 11', 'bn' => 'একাদশ শ্রেণি'], 'sort_order' => 1]);
        EducationClass::create(['education_level_id' => $higherSecondary->id, 'name' => ['en' => 'Class 12', 'bn' => 'দ্বাদশ শ্রেণি'], 'sort_order' => 2]);

        // Branch Campus (Optional but good for demo)
        $branchCampus = Campus::create([
            'name' => [
                'en' => 'City Branch',
                'bn' => 'সিটি শাখা'
            ],
            'sort_order' => 2
        ]);
        
        $branchPrimary = EducationLevel::create([
            'campus_id' => $branchCampus->id,
            'name' => [
                'en' => 'Primary Level',
                'bn' => 'প্রাথমিক স্তর'
            ],
            'description' => [
                'en' => 'Provides foundational education from Class 1 to Class 5 in our branch campus.',
                'bn' => 'আমাদের শাখা ক্যাম্পাসে প্রথম থেকে পঞ্চম শ্রেণি পর্যন্ত মৌলিক শিক্ষা প্রদান করে।'
            ],
            'sort_order' => 1,
        ]);
        EducationClass::create(['education_level_id' => $branchPrimary->id, 'name' => ['en' => 'Class 1', 'bn' => 'প্রথম শ্রেণি'], 'sort_order' => 1]);
        EducationClass::create(['education_level_id' => $branchPrimary->id, 'name' => ['en' => 'Class 2', 'bn' => 'দ্বিতীয় শ্রেণি'], 'sort_order' => 2]);

        // Page Settings
        EducationLevelPageSetting::create([
            'breadcrumb_title' => [
                'en' => 'Our Education Levels',
                'bn' => 'আমাদের শিক্ষার স্তরসমূহ'
            ],
            'seo_title' => [
                'en' => 'Education Levels & Campuses | EduEx School and College',
                'bn' => 'শিক্ষার স্তর ও ক্যাম্পাসসমূহ | এডুএক্স স্কুল এন্ড কলেজ'
            ],
            'seo_description' => [
                'en' => 'Discover the comprehensive education levels and campuses offered by EduEx School and College.',
                'bn' => 'এডুএক্স স্কুল এন্ড কলেজ কর্তৃক প্রদত্ত ব্যাপক শিক্ষার স্তর এবং ক্যাম্পাসসমূহ সম্পর্কে জানুন।'
            ]
        ]);
    }
}
