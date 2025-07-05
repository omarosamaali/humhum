<?php

// database/migrations/YYYY_MM_DD_HHMMSS_create_recipes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kitchen_type_id')->constrained('kitchens')->onDelete('cascade');
            $table->foreignId('chef_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('main_category_id')->constrained('main_categories')->onDelete('cascade');
            $table->string('dish_image')->nullable();
            $table->string('title');
            $table->longText('ingredients');
            $table->longText('steps')->nullable();
            $table->integer('servings');
            $table->integer('preparation_time');
            $table->integer('calories')->nullable();
            $table->decimal('fats', 8, 2)->nullable();
            $table->decimal('carbs', 8, 2)->nullable();
            $table->decimal('protein', 8, 2)->nullable();
            $table->boolean('is_free')->default(true);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
