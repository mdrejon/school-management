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
        Schema::table('vision_mission_page_settings', function (Blueprint $table) {
            // Mission columns
            $table->json('mission_tagline')->nullable();
            $table->json('mission_title')->nullable();
            $table->json('mission_highlight')->nullable();
            $table->json('mission_description')->nullable();
            $table->json('mission_experience_text')->nullable();
            $table->string('mission_image_1')->nullable();
            $table->string('mission_image_2')->nullable();
            $table->string('mission_image_3')->nullable();

            // Values columns
            $table->json('values_tagline')->nullable();
            $table->json('values_title')->nullable();
            $table->json('values_highlight')->nullable();
            $table->json('values_description')->nullable();
            $table->json('values_experience_text')->nullable();
            $table->string('values_image_1')->nullable();
            $table->string('values_image_2')->nullable();
            $table->string('values_image_3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vision_mission_page_settings', function (Blueprint $table) {
            $table->dropColumn([
                'mission_tagline',
                'mission_title',
                'mission_highlight',
                'mission_description',
                'mission_experience_text',
                'mission_image_1',
                'mission_image_2',
                'mission_image_3',
                'values_tagline',
                'values_title',
                'values_highlight',
                'values_description',
                'values_experience_text',
                'values_image_1',
                'values_image_2',
                'values_image_3',
            ]);
        });
    }
};
