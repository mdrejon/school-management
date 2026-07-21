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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();

            // Card + list fields
            $table->json('title');
            $table->json('category')->nullable();
            $table->string('thumbnail')->nullable();
            $table->json('short_description')->nullable();
            $table->unsignedInteger('lessons_count')->nullable();
            $table->decimal('rating', 2, 1)->nullable();
            $table->unsignedInteger('seats')->nullable();
            $table->json('duration')->nullable();
            $table->string('price')->nullable();

            // Detail page fields
            $table->json('description')->nullable();
            $table->string('gallery_image_1')->nullable();
            $table->string('gallery_image_2')->nullable();
            $table->json('instructor_name')->nullable();
            $table->string('instructor_image')->nullable();
            $table->json('enrolled_text')->nullable();
            $table->json('requirement_title')->nullable();
            $table->json('requirement_items')->nullable();
            $table->json('experience_title')->nullable();
            $table->json('experience_description')->nullable();
            $table->json('features')->nullable();

            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
