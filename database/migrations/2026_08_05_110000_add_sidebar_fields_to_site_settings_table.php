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
            $table->boolean('sidebar_notice_show')->default(true);
            $table->json('sidebar_notice_title')->nullable();
            $table->integer('sidebar_notice_limit')->default(4);

            $table->boolean('sidebar_minister_show')->default(true);
            $table->string('sidebar_minister_photo')->nullable();
            $table->json('sidebar_minister_name')->nullable();
            $table->json('sidebar_minister_role')->nullable();
            $table->json('sidebar_minister_button_text')->nullable();
            $table->string('sidebar_minister_button_url')->nullable();

            $table->boolean('sidebar_secretary_show')->default(true);
            $table->string('sidebar_secretary_photo')->nullable();
            $table->json('sidebar_secretary_name')->nullable();
            $table->json('sidebar_secretary_role')->nullable();
            $table->json('sidebar_secretary_button_text')->nullable();
            $table->string('sidebar_secretary_button_url')->nullable();

            $table->boolean('sidebar_principal_show')->default(true);
            $table->json('sidebar_principal_button_text')->nullable();

            $table->boolean('sidebar_vice_principal_show')->default(true);
            $table->string('sidebar_vice_principal_photo')->nullable();
            $table->json('sidebar_vice_principal_name')->nullable();
            $table->json('sidebar_vice_principal_role')->nullable();
            $table->json('sidebar_vice_principal_button_text')->nullable();
            $table->string('sidebar_vice_principal_button_url')->nullable();

            $table->boolean('sidebar_calendar_show')->default(true);
            $table->json('sidebar_calendar_title')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'sidebar_notice_show',
                'sidebar_notice_title',
                'sidebar_notice_limit',
                'sidebar_minister_show',
                'sidebar_minister_photo',
                'sidebar_minister_name',
                'sidebar_minister_role',
                'sidebar_minister_button_text',
                'sidebar_minister_button_url',
                'sidebar_secretary_show',
                'sidebar_secretary_photo',
                'sidebar_secretary_name',
                'sidebar_secretary_role',
                'sidebar_secretary_button_text',
                'sidebar_secretary_button_url',
                'sidebar_principal_show',
                'sidebar_principal_button_text',
                'sidebar_vice_principal_show',
                'sidebar_vice_principal_photo',
                'sidebar_vice_principal_name',
                'sidebar_vice_principal_role',
                'sidebar_vice_principal_button_text',
                'sidebar_vice_principal_button_url',
                'sidebar_calendar_show',
                'sidebar_calendar_title',
            ]);
        });
    }
};
