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
        Schema::table('students', function (Blueprint $table) {
            if (!Schema::hasColumn('students', 'external_id')) {
                $table->string('external_id')->nullable()->unique()->after('id');
            }
            $table->unsignedBigInteger('user_id')->nullable()->change();
            $table->string('guardian_name')->nullable()->change();
            
            // Add performance index for searching
            $table->index(['class_id', 'section_id', 'roll_no'], 'students_class_section_roll_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            if (Schema::hasColumn('students', 'external_id')) {
                $table->dropColumn('external_id');
            }
            $table->dropIndex('students_class_section_roll_idx');
        });
    }
};
