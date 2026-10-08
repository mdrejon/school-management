<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exam_results', function (Blueprint $table) {
            $table->id();
            $table->string('external_id')->unique()->index();
            $table->foreignId('exam_id')->nullable()->constrained('global_exams')->nullOnDelete();
            $table->string('exam_name');
            $table->foreignId('student_id')->nullable()->constrained('students')->nullOnDelete();
            $table->string('student_external_id')->nullable()->index();
            $table->string('student_name');
            $table->string('roll_no')->index();
            $table->string('registration_no')->nullable()->index();
            $table->foreignId('class_id')->nullable()->constrained('academic_classes')->nullOnDelete();
            $table->string('class_name');
            $table->string('section_name')->nullable();
            $table->string('group_name')->nullable();
            $table->string('academic_year')->nullable()->index();
            $table->decimal('total_marks', 8, 2)->nullable();
            $table->decimal('obtained_marks', 8, 2)->nullable();
            $table->decimal('gpa', 4, 2)->nullable();
            $table->string('grade')->nullable();
            $table->string('merit_position')->nullable();
            $table->string('status')->default('PASSED');
            $table->text('remarks')->nullable();
            $table->json('subjects_data')->nullable();
            $table->string('pdf_marksheet')->nullable();
            $table->boolean('is_published')->default(true);
            $table->date('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_results');
    }
};
