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
            // Breadcrumb + SEO for the dedicated /about page — distinct from
            // the existing about_* columns, which are the "About Us"
            // homepage section's own content (photos/badge/feature items).
            $table->json('about_page_breadcrumb_title')->nullable();
            $table->string('about_page_breadcrumb_image')->nullable();
            $table->json('about_page_seo_title')->nullable();
            $table->json('about_page_seo_description')->nullable();
            $table->json('about_page_seo_keywords')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'about_page_breadcrumb_title',
                'about_page_breadcrumb_image',
                'about_page_seo_title',
                'about_page_seo_description',
                'about_page_seo_keywords',
            ]);
        });
    }
};
