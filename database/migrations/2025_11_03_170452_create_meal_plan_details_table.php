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
        Schema::create('meal_plan_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meal_plan_id')->constrained()->onDelete('cascade');
            $table->date('meal_date');
            $table->enum('meal_type', ['breakfast', 'lunch', 'dinner']);
            $table->foreignId('recipe_id')->constrained()->onDelete('cascade');
            $table->boolean('is_active')->default(true);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('salad_id')->nullable()->constrained('recipes')->onDelete('cascade');
            $table->foreignId('drink_id')->nullable()->constrained('recipes')->onDelete('cascade');
            $table->foreignId('appetizers_id')->nullable()->constrained('recipes')->onDelete('cascade');
            $table->foreignId('healthy_food_id')->nullable()->constrained('recipes')->onDelete('cascade');
            $table->foreignId('soup_id')->nullable()->constrained('recipes')->onDelete('cascade');
            $table->foreignId('desserts_id')->nullable()->constrained('recipes')->onDelete('cascade');
            $table->foreignId('sauces_id')->nullable()->constrained('recipes')->onDelete('cascade');
            $table->foreignId('side_dish_id')->nullable()->constrained('recipes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_plan_details');
    }
};
