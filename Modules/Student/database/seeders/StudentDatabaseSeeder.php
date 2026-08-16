<?php

namespace Modules\Student\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Academic\Models\AcademicClass;
use Modules\Academic\Models\Section;
use Modules\Academic\Models\StudentCategory;
use Modules\Student\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Student Categories
        $categories = [];
        foreach (['Regular', 'Irregular', 'Scholarship'] as $categoryName) {
            $categories[] = StudentCategory::firstOrCreate(['name' => $categoryName]);
        }

        $classes = AcademicClass::all();
        $sections = Section::all();

        if ($classes->isEmpty() || $sections->isEmpty()) {
            return; // Requires academic data first
        }

        // Seed Students
        for ($i = 1; $i <= 20; $i++) {
            $email = "student{$i}@example.com";
            
            $user = User::firstOrCreate([
                'email' => $email,
            ], [
                'name' => "Student Name {$i}",
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]);

            // Assign role
            if (!$user->hasRole('student')) {
                // Check if role exists, else don't assign to avoid error
                $role = \Spatie\Permission\Models\Role::where('name', 'student')->first();
                if ($role) {
                    $user->assignRole($role);
                }
            }

            $class = $classes->random();
            $section = $sections->where('academic_class_id', $class->id)->random();

            Student::firstOrCreate([
                'user_id' => $user->id,
            ], [
                'first_name' => "Student",
                'last_name' => "Name {$i}",
                'father_name' => "Father Name {$i}",
                'mother_name' => "Mother Name {$i}",
                'class_id' => $class->id,
                'section_id' => $section ? $section->id : null,
                'group' => 'Science', // Example
                'gender' => $i % 2 == 0 ? 'Male' : 'Female',
                'roll_no' => $i,
                'registration_no' => 'REG' . 1000 + $i,
                'blood_group' => 'A+',
                'religion' => 'Islam',
                'admission_number' => 'ADM' . 1000 + $i,
                'address' => "Address {$i}",
                'guardian_name' => "Guardian {$i}",
                'guardian_email' => "guardian{$i}@example.com",
                'guardian_phone' => "017000000" . sprintf('%02d', $i),
                'guardian_relationship' => "Father",
            ]);
        }
    }
}
