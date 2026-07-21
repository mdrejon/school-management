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
        Schema::create('teacher_page_settings', function (Blueprint $table) {
            $table->id();
            $table->json('section_tagline')->nullable();
            $table->json('section_title')->nullable();
            $table->json('section_highlight')->nullable();
            $table->json('section_description')->nullable();
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
        Schema::dropIfExists('teacher_page_settings');
    }
};
