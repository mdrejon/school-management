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
        Schema::table('site_settings', function (Blueprint $table) {
            // Homepage "Latest Video" block — a single item, not a repeater,
            // same title/highlight/description/button shape as Slider.
            $table->json('video_tagline')->nullable();
            $table->json('video_title')->nullable();
            $table->json('video_highlight')->nullable();
            $table->json('video_description')->nullable();
            $table->json('video_button_text')->nullable();
            $table->string('video_button_url')->nullable();
            $table->string('video_youtube_url')->nullable();
            $table->string('video_thumbnail')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'video_tagline',
                'video_title',
                'video_highlight',
                'video_description',
                'video_button_text',
                'video_button_url',
                'video_youtube_url',
                'video_thumbnail',
            ]);
        });
    }
};
