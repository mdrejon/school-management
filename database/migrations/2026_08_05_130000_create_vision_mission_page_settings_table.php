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
        Schema::create('vision_mission_page_settings', function (Blueprint $table) {
            $table->id();
            $table->json('tagline')->nullable();
            $table->json('title')->nullable();
            $table->json('highlight')->nullable();
            $table->json('description')->nullable();
            $table->json('experience_text')->nullable();
            $table->json('quote')->nullable();
            $table->json('button_text')->nullable();
            $table->string('button_url')->nullable();
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->string('image_3')->nullable();
            $table->json('breadcrumb_title')->nullable();
            $table->string('breadcrumb_image')->nullable();
            $table->json('seo_title')->nullable();
            $table->json('seo_description')->nullable();
            $table->json('seo_keywords')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vision_mission_page_settings');
    }
};
