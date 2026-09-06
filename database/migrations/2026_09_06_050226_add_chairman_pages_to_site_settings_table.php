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
            $table->string('chairman_photo')->nullable()->after('about_page_seo_keywords');
            $table->json('chairman_name')->nullable()->after('chairman_photo');
            $table->json('chairman_designation')->nullable()->after('chairman_name');
            $table->json('chairman_message')->nullable()->after('chairman_designation');
            $table->string('chairman_page_breadcrumb_image')->nullable()->after('chairman_message');
            $table->json('chairman_page_breadcrumb_title')->nullable()->after('chairman_page_breadcrumb_image');
            $table->json('chairman_page_seo_title')->nullable()->after('chairman_page_breadcrumb_title');
            $table->json('chairman_page_seo_description')->nullable()->after('chairman_page_seo_title');
            $table->json('chairman_page_seo_keywords')->nullable()->after('chairman_page_seo_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'chairman_photo',
                'chairman_name',
                'chairman_designation',
                'chairman_message',
                'chairman_page_breadcrumb_image',
                'chairman_page_breadcrumb_title',
                'chairman_page_seo_title',
                'chairman_page_seo_description',
                'chairman_page_seo_keywords',
            ]);
        });
    }
};
