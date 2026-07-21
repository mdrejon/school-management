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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();

            $table->json('name');
            $table->json('designation')->nullable();
            $table->string('photo')->nullable();
            $table->json('short_intro')->nullable();
            $table->json('address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('whatsapp_url')->nullable();
            $table->string('behance_url')->nullable();
            $table->string('pinterest_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->json('biography')->nullable();
            $table->json('skills')->nullable();

            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
