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
            $table->json('sidebar_minister_title')->nullable()->after('sidebar_minister_show');
            $table->json('sidebar_secretary_title')->nullable()->after('sidebar_secretary_show');
            $table->json('sidebar_principal_title')->nullable()->after('sidebar_principal_show');
            $table->json('sidebar_vice_principal_title')->nullable()->after('sidebar_vice_principal_show');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'sidebar_minister_title',
                'sidebar_secretary_title',
                'sidebar_principal_title',
                'sidebar_vice_principal_title',
            ]);
        });
    }
};
