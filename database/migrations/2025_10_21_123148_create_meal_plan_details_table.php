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
            $table->enum('meal_type', ['breakfast', 'lunch', 'dinner'])->nullable();
            $table->foreignId('recipe_id')->nullable()->constrained('recipes')->onDelete('set null');
            $table->time('meal_time')->nullable();
            $table->json('additions')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);
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
