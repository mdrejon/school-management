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
            $table->json('footer_quick_links_title')->nullable();
            $table->json('footer_quick_links')->nullable();
            $table->json('footer_campus_title')->nullable();
            $table->json('footer_campus_links')->nullable();
            $table->json('footer_newsletter_title')->nullable();
            $table->json('footer_newsletter_text')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'footer_quick_links_title',
                'footer_quick_links',
                'footer_campus_title',
                'footer_campus_links',
                'footer_newsletter_title',
                'footer_newsletter_text',
            ]);
        });
    }
};
