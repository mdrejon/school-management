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
        Schema::table('class_routines', function (Blueprint $table) {
            if (!Schema::hasColumn('class_routines', 'external_id')) {
                $table->string('external_id')->nullable()->unique()->after('id');
            }
            if (!Schema::hasColumn('class_routines', 'routine_file')) {
                $table->string('routine_file')->nullable()->after('room');
            }
            $table->unsignedBigInteger('subject_id')->nullable()->change();
            $table->unsignedBigInteger('teacher_id')->nullable()->change();

            $table->index(['class_id', 'section_id', 'day_of_week'], 'routines_class_section_day_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('class_routines', function (Blueprint $table) {
            if (Schema::hasColumn('class_routines', 'external_id')) {
                $table->dropColumn('external_id');
            }
            if (Schema::hasColumn('class_routines', 'routine_file')) {
                $table->dropColumn('routine_file');
            }
            $table->dropIndex('routines_class_section_day_idx');
        });
    }
};
