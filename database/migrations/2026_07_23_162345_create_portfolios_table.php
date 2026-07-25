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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();

            // Card fields
            $table->json('title');
            $table->json('category')->nullable();
            $table->string('image')->nullable();

            // Detail page fields
            $table->json('description')->nullable();
            $table->string('gallery_image_1')->nullable();
            $table->string('gallery_image_2')->nullable();
            $table->json('highlight_title')->nullable();
            $table->json('highlight_items')->nullable();
            $table->json('overview_title')->nullable();
            $table->json('overview_description')->nullable();

            // Sidebar meta
            $table->string('client_name')->nullable();
            $table->date('event_date')->nullable();
            $table->string('cost')->nullable();
            $table->string('manager_name')->nullable();
            $table->string('location')->nullable();
            $table->string('website_url')->nullable();
            $table->unsignedTinyInteger('rating')->nullable();

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
        Schema::dropIfExists('portfolios');
    }
};
