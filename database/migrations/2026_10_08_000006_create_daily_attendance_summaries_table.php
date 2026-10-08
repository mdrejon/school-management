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
        Schema::create('daily_attendance_summaries', function (Blueprint $table) {
            $table->id();
            $table->string('external_id')->nullable()->unique();
            $table->date('date');
            $table->unsignedBigInteger('class_id')->nullable();
            $table->string('class_name')->nullable();
            $table->unsignedBigInteger('section_id')->nullable();
            $table->string('section_name')->nullable();
            $table->integer('total_students')->default(0);
            $table->integer('present_count')->default(0);
            $table->integer('absent_count')->default(0);
            $table->integer('leave_count')->default(0);
            $table->integer('late_count')->default(0);
            $table->decimal('attendance_rate', 5, 2)->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->index(['date', 'class_name'], 'att_sum_date_class_idx');
            $table->index('date', 'att_sum_date_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_attendance_summaries');
    }
};
