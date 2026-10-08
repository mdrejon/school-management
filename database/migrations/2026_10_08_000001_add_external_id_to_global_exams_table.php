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
        Schema::table('global_exams', function (Blueprint $table) {
            $table->string('external_id')->nullable()->unique()->after('id');
            $table->string('code')->nullable()->after('name');
            $table->string('academic_year')->nullable()->after('code');
            $table->boolean('is_active')->default(true)->after('academic_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('global_exams', function (Blueprint $table) {
            $table->dropColumn(['external_id', 'code', 'academic_year', 'is_active']);
        });
    }
};
