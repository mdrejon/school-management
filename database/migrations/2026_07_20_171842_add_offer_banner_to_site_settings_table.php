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
            // Homepage promotional banner ("Our 20% Offer Running...") — a
            // single item, same shape as the video block. Prefixed `offer_`
            // rather than `cta_` since `cta_stats` already names the
            // counter-strip repeater; this is a different section.
            $table->json('offer_title')->nullable();
            $table->json('offer_description')->nullable();
            $table->json('offer_button_text')->nullable();
            $table->string('offer_button_url')->nullable();
            $table->string('offer_background')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'offer_title',
                'offer_description',
                'offer_button_text',
                'offer_button_url',
                'offer_background',
            ]);
        });
    }
};
