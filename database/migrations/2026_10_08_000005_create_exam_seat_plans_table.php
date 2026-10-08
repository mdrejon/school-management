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
        Schema::create('exam_seat_plans', function (Blueprint $table) {
            $table->id();
            $table->string('external_id')->nullable()->unique();
            $table->unsignedBigInteger('exam_id')->nullable();
            $table->string('exam_name');
            $table->string('academic_year')->nullable();
            $table->unsignedBigInteger('class_id')->nullable();
            $table->string('class_name')->nullable();
            $table->unsignedBigInteger('section_id')->nullable();
            $table->string('section_name')->nullable();
            $table->string('room_no');
            $table->string('building_name')->nullable();
            $table->string('roll_from')->nullable();
            $table->string('roll_to')->nullable();
            $table->text('allocated_rolls')->nullable();
            $table->integer('total_seats')->default(0);
            $table->date('exam_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('file_path')->nullable();
            $table->text('instructions')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();

            $table->index(['exam_name', 'class_name'], 'seat_plans_exam_class_idx');
            $table->index('room_no', 'seat_plans_room_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_seat_plans');
    }
};
