<?php

namespace Modules\Exam\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Exam\Models\GlobalExamCode;
use Modules\Exam\Models\GlobalExamGrade;
use Modules\Exam\Models\GlobalExam;

class ExamDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Global Exam Codes
        for ($i = 1; $i <= 6; $i++) {
            GlobalExamCode::firstOrCreate(['title' => 'SC-' . $i], [
                'total_marks' => 100,
                'pass_marks' => 0,
                'acceptance' => 1.00,
            ]);
        }

        // Global Exam Grades
        $grades = [
            ['grade' => 'A+', 'grade_range' => '80-100'],
            ['grade' => 'A', 'grade_range' => '70-79'],
            ['grade' => 'A-', 'grade_range' => '60-69'],
            ['grade' => 'B', 'grade_range' => '50-59'],
            ['grade' => 'C', 'grade_range' => '40-49'],
            ['grade' => 'D', 'grade_range' => '33-39'],
            ['grade' => 'F', 'grade_range' => '00-32'],
        ];

        foreach ($grades as $grade) {
            GlobalExamGrade::firstOrCreate(['grade' => $grade['grade']], [
                'grade_range' => $grade['grade_range'],
            ]);
        }

        // Global Exams
        $exams = ['1st Term', '2nd Term'];
        foreach ($exams as $exam) {
            GlobalExam::firstOrCreate(['name' => $exam]);
        }
    }
}
