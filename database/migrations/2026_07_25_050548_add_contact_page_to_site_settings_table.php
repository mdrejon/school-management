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
            // "Contact Us" page — office hours + the "Get In Touch" form's
            // intro heading/image/map. Address/phone/email reuse the site's
            // existing global fields, same as the Principal page's contact
            // block, rather than duplicating them here.
            $table->json('contact_open_time')->nullable();
            $table->json('contact_form_title')->nullable();
            $table->json('contact_form_description')->nullable();
            $table->string('contact_image')->nullable();
            $table->string('contact_map_embed_url')->nullable();
            $table->json('contact_page_breadcrumb_title')->nullable();
            $table->string('contact_page_breadcrumb_image')->nullable();
            $table->json('contact_page_seo_title')->nullable();
            $table->json('contact_page_seo_description')->nullable();
            $table->json('contact_page_seo_keywords')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'contact_open_time',
                'contact_form_title',
                'contact_form_description',
                'contact_image',
                'contact_map_embed_url',
                'contact_page_breadcrumb_title',
                'contact_page_breadcrumb_image',
                'contact_page_seo_title',
                'contact_page_seo_description',
                'contact_page_seo_keywords',
            ]);
        });
    }
};
