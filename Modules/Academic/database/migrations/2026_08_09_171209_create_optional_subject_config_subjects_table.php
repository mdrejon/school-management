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
        Schema::create('optional_subject_config_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('optional_subject_config_id')->constrained('optional_subject_configs')->cascadeOnDelete()->name('osc_id_foreign');
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('optional_subject_config_subjects');
    }
};
