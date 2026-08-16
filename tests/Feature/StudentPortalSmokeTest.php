<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentPortalSmokeTest extends TestCase
{
    protected $student;

    protected function setUp(): void
    {
        parent::setUp();
        // Get the seeded student
        $this->student = User::role('student')->first();
    }

    public function test_student_dashboard_renders()
    {
        if (!$this->student) {
            $this->markTestSkipped('No student user found.');
        }
        $this->actingAs($this->student)
             ->get(route('student.dashboard'))
             ->assertStatus(200);
    }

    public function test_student_assignments_renders()
    {
        if (!$this->student) {
            $this->markTestSkipped('No student user found.');
        }
        $this->actingAs($this->student)
             ->get(route('student.assignments.index'))
             ->assertStatus(200);
    }

    public function test_student_assignments_submissions_renders()
    {
        if (!$this->student) {
            $this->markTestSkipped('No student user found.');
        }
        $this->actingAs($this->student)
             ->get(route('student.assignments.submissions'))
             ->assertStatus(200);
    }

    public function test_student_syllabus_renders()
    {
        if (!$this->student) {
            $this->markTestSkipped('No student user found.');
        }
        $this->actingAs($this->student)
             ->get(route('student.syllabus.index'))
             ->assertStatus(200);
    }

    public function test_student_subjects_renders()
    {
        if (!$this->student) {
            $this->markTestSkipped('No student user found.');
        }
        $this->actingAs($this->student)
             ->get(route('student.subjects.index'))
             ->assertStatus(200);
    }

    public function test_student_class_routine_renders()
    {
        if (!$this->student) {
            $this->markTestSkipped('No student user found.');
        }
        $this->actingAs($this->student)
             ->get(route('student.class-routine.index'))
             ->assertStatus(200);
    }

    public function test_student_exam_routine_renders()
    {
        if (!$this->student) {
            $this->markTestSkipped('No student user found.');
        }
        $this->actingAs($this->student)
             ->get(route('student.exam-routine.index'))
             ->assertStatus(200);
    }
}
