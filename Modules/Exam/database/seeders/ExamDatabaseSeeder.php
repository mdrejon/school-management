<?php

namespace Modules\Exam\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Exam\Models\GlobalExam;
use Modules\Exam\Models\GlobalExamGrade;
use Modules\Exam\Models\GlobalExamCode;
use Modules\Exam\Models\ClassExam;
use Modules\Exam\Models\ExamMark;
use Modules\Exam\Models\ExamStudentMark;
use Modules\Student\Models\Student;
use Modules\Academic\Models\Subject;

class ExamDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Global Exams
        $examHalf = GlobalExam::firstOrCreate(['name' => 'Half Yearly Exam']);
        $examFinal = GlobalExam::firstOrCreate(['name' => 'Annual Exam']);

        // Grades
        $grades = [
            ['grade' => 'A+', 'grade_range' => '80-100'],
            ['grade' => 'A', 'grade_range' => '70-79'],
            ['grade' => 'A-', 'grade_range' => '60-69'],
            ['grade' => 'B', 'grade_range' => '50-59'],
            ['grade' => 'C', 'grade_range' => '40-49'],
            ['grade' => 'D', 'grade_range' => '33-39'],
            ['grade' => 'F', 'grade_range' => '0-32'],
        ];

        foreach ($grades as $grade) {
            GlobalExamGrade::firstOrCreate($grade);
        }

        // Exam Marks Definition (like Written, MCQ)
        $markWritten = ExamMark::firstOrCreate(['title' => 'Written']);
        $markMcq = ExamMark::firstOrCreate(['title' => 'MCQ']);

        // Students & Subjects for ClassExams and Marks
        $students = Student::all();
        $subjects = Subject::all();

        if ($students->isEmpty() || $subjects->isEmpty()) {
            return;
        }

        // We assign exams to classes via ClassExam
        $classes = $students->pluck('class_id')->unique();
        
        foreach ($classes as $classId) {
            $classExamHalf = ClassExam::firstOrCreate([
                'class_id' => $classId,
                'global_exam_id' => $examHalf->id,
            ], ['merit_type' => 'GPA']);
            
            $classExamFinal = ClassExam::firstOrCreate([
                'class_id' => $classId,
                'global_exam_id' => $examFinal->id,
            ], ['merit_type' => 'GPA']);
            
            // Seed student marks for Half Yearly
            $classStudents = $students->where('class_id', $classId);
            $classSubjects = $subjects->where('academic_class_id', $classId);

            foreach ($classStudents as $student) {
                foreach ($classSubjects as $subject) {
                    // Written mark
                    ExamStudentMark::firstOrCreate([
                        'student_id' => $student->id,
                        'class_id' => $student->class_id,
                        'section_id' => $student->section_id,
                        'exam_id' => $classExamHalf->id,
                        'subject_id' => $subject->id,
                        'exam_mark_id' => $markWritten->id,
                    ], [
                        'marks_obtained' => rand(30, 70),
                    ]);

                    // MCQ mark
                    ExamStudentMark::firstOrCreate([
                        'student_id' => $student->id,
                        'class_id' => $student->class_id,
                        'section_id' => $student->section_id,
                        'exam_id' => $classExamHalf->id,
                        'subject_id' => $subject->id,
                        'exam_mark_id' => $markMcq->id,
                    ], [
                        'marks_obtained' => rand(10, 30),
                    ]);
                }
            }
        }
    }
}
