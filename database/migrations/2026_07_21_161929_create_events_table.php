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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();

            // Card + list fields
            $table->json('title');
            $table->json('location')->nullable();
            $table->string('image')->nullable();
            $table->date('event_date')->nullable();
            $table->string('event_time')->nullable();
            $table->json('short_description')->nullable();

            // Detail page fields
            $table->json('content_blocks')->nullable();
            $table->string('gallery_image_1')->nullable();
            $table->string('gallery_image_2')->nullable();
            $table->text('map_embed_url')->nullable();
            $table->json('sidebar_intro')->nullable();
            $table->string('cost')->nullable();
            $table->json('button_text')->nullable();
            $table->string('button_url')->nullable();
            $table->json('organizer_name')->nullable();
            $table->string('organizer_photo')->nullable();
            $table->json('organizer_bio')->nullable();

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
        Schema::dropIfExists('events');
    }
};
