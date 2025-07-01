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
        Schema::create('snaps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to users table, mandatory
            $table->string('video_path'); // Path to the video file, mandatory
            $table->string('name'); // Name/description for the video, mandatory
            $table->string('status')->default('draft'); // 'published' or 'draft', mandatory with default

            // Optional foreign keys
            $table->foreignId('kitchen_id')->nullable()->constrained('kitchens')->onDelete('set null');
            $table->foreignId('main_category_id')->nullable()->constrained('main_categories')->onDelete('set null');
            $table->foreignId('sub_category_id')->nullable()->constrained('sub_categories')->onDelete('set null');
            $table->foreignId('recipe_id')->nullable()->constrained('recipes')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('snaps');
    }
};
