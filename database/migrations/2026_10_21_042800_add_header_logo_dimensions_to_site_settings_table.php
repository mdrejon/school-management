<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('header_logo_height', 50)->nullable()->default('110px')->after('logo');
            $table->string('header_logo_width', 50)->nullable()->default('auto')->after('header_logo_height');
        });

        // Initialize default for existing row if present
        DB::table('site_settings')->update([
            'header_logo_height' => '110px',
            'header_logo_width' => 'auto',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['header_logo_height', 'header_logo_width']);
        });
    }
};
