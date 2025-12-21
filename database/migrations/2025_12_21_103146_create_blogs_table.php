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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt');
            $table->longText('content'); // HTML content
            $table->string('author_name')->nullable();
            $table->string('author_role')->nullable();
            $table->string('category'); // Bill Savings, Tariff Updates, Solar Energy, Guides, etc.
            $table->integer('reading_time'); // in minutes
            $table->dateTime('published_at');
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('featured_image_alt')->nullable();
            $table->string('provider_key')->nullable(); // Link to provider (iesco, lesco, etc.)
            $table->string('icon_name')->nullable(); // Iconify icon name for featured image
            $table->string('gradient_from')->nullable(); // Tailwind gradient color from
            $table->string('gradient_to')->nullable(); // Tailwind gradient color to
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
