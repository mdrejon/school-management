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
            // "About Us" — single item + a repeater of feature items (same
            // icon/title/description shape as choose_features). The "Call
            // Now" number reuses the existing global `phone` column rather
            // than duplicating it here.
            $table->json('about_tagline')->nullable();
            $table->json('about_title')->nullable();
            $table->json('about_highlight')->nullable();
            $table->json('about_description')->nullable();
            $table->json('about_quote')->nullable();
            $table->json('about_button_text')->nullable();
            $table->string('about_button_url')->nullable();
            $table->json('about_badge_icon')->nullable();
            $table->json('about_badge_text')->nullable();
            $table->string('about_image_1')->nullable();
            $table->string('about_image_2')->nullable();
            $table->string('about_image_3')->nullable();
            $table->json('about_items')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'about_tagline',
                'about_title',
                'about_highlight',
                'about_description',
                'about_quote',
                'about_button_text',
                'about_button_url',
                'about_badge_icon',
                'about_badge_text',
                'about_image_1',
                'about_image_2',
                'about_image_3',
                'about_items',
            ]);
        });
    }
};
