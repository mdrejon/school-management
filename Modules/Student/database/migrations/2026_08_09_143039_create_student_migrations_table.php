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
        Schema::create('student_migrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            
            $table->unsignedBigInteger('from_class_id')->nullable();
            $table->unsignedBigInteger('from_section_id')->nullable();
            
            $table->unsignedBigInteger('to_class_id')->nullable();
            $table->unsignedBigInteger('to_section_id')->nullable();
            
            $table->string('academic_year')->nullable();
            $table->string('migration_type')->nullable(); // e.g. promotion, demotion
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_migrations');
    }
};
