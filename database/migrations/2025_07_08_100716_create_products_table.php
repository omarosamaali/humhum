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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // عمود المعرف الرئيسي التلقائي
            $table->string('name'); // اسم المنتج
            $table->decimal('price', 8, 2); // سعر المنتج (مثال: 999999.99)
            $table->enum('type', ['physical', 'digital']); // نوع المنتج: مادي أو رقمي
            $table->string('image_path')->nullable(); // مسار صورة المنتج، يمكن أن يكون فارغًا
            $table->timestamps(); // عمودين created_at و updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
