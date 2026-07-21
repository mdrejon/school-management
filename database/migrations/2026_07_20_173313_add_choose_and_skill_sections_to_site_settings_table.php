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
            // "Why Choose Us" — single item + a repeater of feature boxes
            // (icon, translatable title, translatable description).
            $table->json('choose_tagline')->nullable();
            $table->json('choose_title')->nullable();
            $table->json('choose_highlight')->nullable();
            $table->json('choose_description')->nullable();
            $table->string('choose_image')->nullable();
            $table->json('choose_features')->nullable();

            // "Our Skills" (enrollment card + skill bars) — single item +
            // a repeater of skill bars (translatable label, plain percentage).
            // Enrollment form fields themselves (name/email/course/message)
            // stay static theme UI, not admin content — only the card's
            // heading/subheading are editable.
            $table->json('skill_enroll_title')->nullable();
            $table->json('skill_enroll_subtitle')->nullable();
            $table->json('skill_tagline')->nullable();
            $table->json('skill_title')->nullable();
            $table->json('skill_highlight')->nullable();
            $table->json('skill_description')->nullable();
            $table->json('skill_button_text')->nullable();
            $table->string('skill_button_url')->nullable();
            $table->json('skill_items')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'choose_tagline',
                'choose_title',
                'choose_highlight',
                'choose_description',
                'choose_image',
                'choose_features',
                'skill_enroll_title',
                'skill_enroll_subtitle',
                'skill_tagline',
                'skill_title',
                'skill_highlight',
                'skill_description',
                'skill_button_text',
                'skill_button_url',
                'skill_items',
            ]);
        });
    }
};
