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
        Schema::create('optional_subject_configs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('academic_class_id')->nullable()->constrained('academic_classes')->cascadeOnDelete();
            $table->foreignId('academic_group_id')->nullable()->constrained('academic_groups')->cascadeOnDelete();
            $table->integer('limit')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('optional_subject_configs');
    }
};
