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
            $table->string('student_list_page_breadcrumb_image')->nullable();
            $table->json('student_list_page_breadcrumb_title')->nullable();
            $table->json('student_list_page_seo_title')->nullable();
            $table->json('student_list_page_seo_description')->nullable();
            $table->json('student_list_page_seo_keywords')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'student_list_page_breadcrumb_image',
                'student_list_page_breadcrumb_title',
                'student_list_page_seo_title',
                'student_list_page_seo_description',
                'student_list_page_seo_keywords',
            ]);
        });
    }
};
