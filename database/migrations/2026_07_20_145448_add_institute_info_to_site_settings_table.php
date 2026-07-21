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
            // Repeater: array of { label: {locale: text}, value: {locale: text} }
            // items — both label and value are per-language, unlike the plain
            // JSON-per-field columns used elsewhere (see HasTranslations usage
            // above), since each row is itself a translatable pair rather than
            // a single translatable string.
            $table->json('institute_info')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn('institute_info');
        });
    }
};
