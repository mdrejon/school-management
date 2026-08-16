<?php

namespace Modules\Academic\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Academic\Models\AcademicSession;
use Modules\Academic\Models\Shift;
use Modules\Academic\Models\AcademicClass;
use Modules\Academic\Models\Section;
use Modules\Academic\Models\AcademicGroup;
use Modules\Academic\Models\Department;
use Modules\Academic\Models\Subject;
use Modules\Academic\Models\Period;
use Modules\Academic\Models\SubjectConfig;
use Modules\Academic\Models\ClassRoutine;

class AcademicDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sessions
        $session = AcademicSession::firstOrCreate([
            'year' => date('Y'),
        ], [
            'name' => date('Y') . '-' . (date('Y') + 1),
            'is_active' => true,
        ]);

        // Shifts
        $shiftMorning = Shift::firstOrCreate(['name' => 'Morning']);
        $shiftDay = Shift::firstOrCreate(['name' => 'Day']);

        // Classes
        $classes = [];
        foreach (['Class 6', 'Class 7', 'Class 8', 'Class 9', 'Class 10'] as $className) {
            $classes[] = AcademicClass::firstOrCreate(['name' => $className]);
        }

        // Sections
        $sections = [];
        foreach (['A', 'B'] as $sectionName) {
            // Assigning section A to class 6, group 1 just as an example,
            // but we need to ensure the group exists first.
            // Wait, sections migration has academic_class_id and academic_group_id. Let's make groups first.
        }

        // Groups
        $groups = [];
        foreach (['Science', 'Commerce', 'Arts', 'General'] as $groupName) {
            $groups[] = AcademicGroup::firstOrCreate(['name' => $groupName]);
        }
        
        $generalGroup = $groups[3]; // General

        // Now sections
        foreach ($classes as $class) {
            foreach (['A', 'B'] as $sectionName) {
                $sections[] = Section::firstOrCreate([
                    'academic_class_id' => $class->id,
                    'academic_group_id' => $generalGroup->id,
                    'name' => $sectionName
                ]);
            }
        }

        // Departments (Academic)
        $departments = [];
        foreach (['Bangla', 'English', 'Math', 'Science'] as $deptName) {
            $departments[] = Department::firstOrCreate(['name' => $deptName]);
        }

        // Subjects
        $subjectsData = [
            ['name' => 'Bangla 1st Paper', 'code' => '101', 'type' => 'mandatory', 'short_form' => 'BNG1'],
            ['name' => 'English 1st Paper', 'code' => '107', 'type' => 'mandatory', 'short_form' => 'ENG1'],
            ['name' => 'General Math', 'code' => '109', 'type' => 'mandatory', 'short_form' => 'MATH'],
            ['name' => 'Physics', 'code' => '136', 'type' => 'mandatory', 'short_form' => 'PHY'],
            ['name' => 'Chemistry', 'code' => '137', 'type' => 'mandatory', 'short_form' => 'CHEM'],
        ];

        $subjects = [];
        foreach ($classes as $class) {
            $serial = 1;
            foreach ($subjectsData as $data) {
                $subject = Subject::firstOrCreate([
                    'academic_class_id' => $class->id,
                    'academic_group_id' => $generalGroup->id,
                    'code' => $data['code']
                ], [
                    'name' => $data['name'],
                    'short_form' => $data['short_form'],
                    'type' => $data['type'],
                    'serial_no' => $serial++
                ]);
                
                $subjects[] = $subject;
                
                // Subject config
                SubjectConfig::firstOrCreate([
                    'academic_class_id' => $class->id,
                    'academic_group_id' => $generalGroup->id,
                    'subject_id' => $subject->id,
                ], [
                    'subject_type' => $data['type'],
                    'serial_no' => $subject->serial_no,
                ]);
            }
        }

        // Periods
        $periods = [];
        for ($i = 1; $i <= 6; $i++) {
            $periods[] = Period::firstOrCreate(['serial_no' => $i], [
                'name' => $i . 'th Period'
            ]);
        }

        // Class Routines
        $teachers = \App\Models\User::role('staff')->get(); // Using staff since we created staff
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        
        foreach ($classes as $class) {
            foreach ($sections as $section) {
                if ($section->academic_class_id == $class->id) {
                    foreach ($days as $day) {
                        foreach ($periods as $period) {
                            ClassRoutine::firstOrCreate([
                                'class_id' => $class->id,
                                'section_id' => $section->id,
                                'day_of_week' => $day,
                                'start_time' => sprintf('%02d:00', 8 + $period->serial_no),
                            ], [
                                'end_time' => sprintf('%02d:45', 8 + $period->serial_no),
                                'subject_id' => $subjects[array_rand($subjects)]->id,
                                'teacher_id' => $teachers->count() ? $teachers->random()->id : null,
                                'room' => 'Room ' . rand(101, 199),
                            ]);
                        }
                    }
                }
            }
        }
    }
}
