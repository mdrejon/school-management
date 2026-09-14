<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Campus;
use App\Models\EducationLevel;
use App\Models\EducationClass;

class EducationLevelSeeder extends Seeder
{
    public function run(): void
    {
        $mainCampus = Campus::create(['name' => ['en' => 'Main Campus'], 'sort_order' => 1]);
        
        $noorani = EducationLevel::create([
            'campus_id' => $mainCampus->id,
            'name' => ['en' => 'Noorani Level'],
            'description' => ['en' => 'There are four classes at this level.'],
            'sort_order' => 1,
        ]);
        EducationClass::create(['education_level_id' => $noorani->id, 'name' => ['en' => 'Noorani Children'], 'sort_order' => 1]);
        EducationClass::create(['education_level_id' => $noorani->id, 'name' => ['en' => 'Noorani 1st'], 'sort_order' => 2]);
        EducationClass::create(['education_level_id' => $noorani->id, 'name' => ['en' => 'Noorani 2nd'], 'sort_order' => 3]);
        EducationClass::create(['education_level_id' => $noorani->id, 'name' => ['en' => 'Noorani 3rd'], 'sort_order' => 4]);

        $ibtedayi = EducationLevel::create([
            'campus_id' => $mainCampus->id,
            'name' => ['en' => 'Ibtedayi Level'],
            'description' => ['en' => 'There are five classes at this level.'],
            'sort_order' => 2,
        ]);
        EducationClass::create(['education_level_id' => $ibtedayi->id, 'name' => ['en' => 'Ibtedayi 1st'], 'sort_order' => 1]);
        EducationClass::create(['education_level_id' => $ibtedayi->id, 'name' => ['en' => 'Ibtedayi 2nd'], 'sort_order' => 2]);
        EducationClass::create(['education_level_id' => $ibtedayi->id, 'name' => ['en' => 'Ibtedayi 3rd'], 'sort_order' => 3]);

        $chittagong = Campus::create(['name' => ['en' => 'Chittagong Metropolitan Campus'], 'sort_order' => 2]);
        
        $chittagongNoorani = EducationLevel::create([
            'campus_id' => $chittagong->id,
            'name' => ['en' => 'Noorani Level'],
            'description' => ['en' => 'There are four classes at this level.'],
            'sort_order' => 1,
        ]);
        EducationClass::create(['education_level_id' => $chittagongNoorani->id, 'name' => ['en' => 'Noorani Children'], 'sort_order' => 1]);
    }
}
