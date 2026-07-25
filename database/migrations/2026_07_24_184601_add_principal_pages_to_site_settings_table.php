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
            // "Our Principal" — a single current-principal profile (photo,
            // name, designation, message) plus that page's own breadcrumb/SEO.
            // Contact info reuses the site's global address/phone/email
            // rather than duplicating them here.
            $table->string('principal_photo')->nullable();
            $table->json('principal_name')->nullable();
            $table->json('principal_designation')->nullable();
            $table->json('principal_message')->nullable();
            $table->json('principal_page_breadcrumb_title')->nullable();
            $table->string('principal_page_breadcrumb_image')->nullable();
            $table->json('principal_page_seo_title')->nullable();
            $table->json('principal_page_seo_description')->nullable();
            $table->json('principal_page_seo_keywords')->nullable();

            // "Our EX Principal" — same shape, one former-principal profile
            // (not a repeatable list — the reference template itself only
            // ever shows one former principal at a time).
            $table->string('ex_principal_photo')->nullable();
            $table->json('ex_principal_name')->nullable();
            $table->json('ex_principal_designation')->nullable();
            $table->json('ex_principal_message')->nullable();
            $table->json('ex_principal_page_breadcrumb_title')->nullable();
            $table->string('ex_principal_page_breadcrumb_image')->nullable();
            $table->json('ex_principal_page_seo_title')->nullable();
            $table->json('ex_principal_page_seo_description')->nullable();
            $table->json('ex_principal_page_seo_keywords')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'principal_photo',
                'principal_name',
                'principal_designation',
                'principal_message',
                'principal_page_breadcrumb_title',
                'principal_page_breadcrumb_image',
                'principal_page_seo_title',
                'principal_page_seo_description',
                'principal_page_seo_keywords',
                'ex_principal_photo',
                'ex_principal_name',
                'ex_principal_designation',
                'ex_principal_message',
                'ex_principal_page_breadcrumb_title',
                'ex_principal_page_breadcrumb_image',
                'ex_principal_page_seo_title',
                'ex_principal_page_seo_description',
                'ex_principal_page_seo_keywords',
            ]);
        });
    }
};
