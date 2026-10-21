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
            if (!Schema::hasColumn('site_settings', 'site_title')) {
                $table->json('site_title')->nullable()->after('site_name');
            }
            if (!Schema::hasColumn('site_settings', 'site_tagline')) {
                $table->json('site_tagline')->nullable()->after('site_title');
            }
            if (!Schema::hasColumn('site_settings', 'meta_title')) {
                $table->json('meta_title')->nullable()->after('site_tagline');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['site_title', 'site_tagline', 'meta_title']);
        });
    }
};
