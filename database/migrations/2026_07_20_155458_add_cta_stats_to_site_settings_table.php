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
            // Homepage counter/CTA strip: array of { icon, value, label: {locale: text} }.
            // Same repeater shape as institute_info — icon/value are plain
            // (icon is an asset filename, value is the number the JS counter
            // animates to), only label is per-language.
            $table->json('cta_stats')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn('cta_stats');
        });
    }
};
