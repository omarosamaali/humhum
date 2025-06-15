<?php

// database/migrations/YYYY_MM_DD_HHMMSS_create_recipe_sub_category_table.php (اسم الملف هيكون مختلف عندك)

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recipe_sub_category', function (Blueprint $table) {
            // لا حاجة لـ ID هنا في الجدول الوسيط
            $table->foreignId('recipe_id')->constrained('recipes')->onDelete('cascade');
            $table->foreignId('sub_category_id')->constrained('sub_categories')->onDelete('cascade');
            $table->primary(['recipe_id', 'sub_category_id']); // لضمان عدم تكرار نفس الربط
            $table->timestamps(); // اختياري، لتتبع متى تم الربط
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recipe_sub_category');
    }
};