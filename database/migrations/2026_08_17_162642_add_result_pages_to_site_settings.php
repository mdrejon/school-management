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
            $pages = [
                'exam_result_page',
                'academic_result_page',
                'evaluation_result_page',
                'board_exam_result_page',
            ];

            foreach ($pages as $page) {
                $table->string("{$page}_breadcrumb_image")->nullable();
                $table->json("{$page}_breadcrumb_title")->nullable();
                $table->json("{$page}_seo_title")->nullable();
                $table->json("{$page}_seo_description")->nullable();
                $table->json("{$page}_seo_keywords")->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $pages = [
                'exam_result_page',
                'academic_result_page',
                'evaluation_result_page',
                'board_exam_result_page',
            ];

            $columns = [];
            foreach ($pages as $page) {
                $columns = array_merge($columns, [
                    "{$page}_breadcrumb_image",
                    "{$page}_breadcrumb_title",
                    "{$page}_seo_title",
                    "{$page}_seo_description",
                    "{$page}_seo_keywords",
                ]);
            }
            $table->dropColumn($columns);
        });
    }
};
