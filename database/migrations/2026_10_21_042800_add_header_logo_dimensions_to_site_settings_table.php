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
            if (!Schema::hasColumn('site_settings', 'header_logo_height')) {
                $table->string('header_logo_height', 50)->nullable()->default('110px')->after('logo');
            }
            if (!Schema::hasColumn('site_settings', 'header_logo_width')) {
                $table->string('header_logo_width', 50)->nullable()->default('auto')->after('header_logo_height');
            }
        });

        // Initialize default for existing row if present and not set
        DB::table('site_settings')->whereNull('header_logo_height')->orWhere('header_logo_height', '')->update([
            'header_logo_height' => '110px',
        ]);
        DB::table('site_settings')->whereNull('header_logo_width')->orWhere('header_logo_width', '')->update([
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
