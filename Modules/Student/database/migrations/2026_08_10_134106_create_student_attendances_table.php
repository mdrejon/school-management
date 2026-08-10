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
        Schema::create('student_attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('period_id')->nullable();
            $table->date('date');
            $table->string('status'); // 'present', 'absent'
            $table->boolean('sms_sent')->default(false);
            $table->timestamps();

            // Ensure unique attendance per student, date, and period.
            // If period_id is null, this still works in some databases, but better to be safe.
            $table->unique(['student_id', 'date', 'period_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_attendances');
    }
};
