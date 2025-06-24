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
        Schema::create('delivery_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ربط المكان بالمستخدم (الشيف)
            $table->string('country'); // الدولة
            $table->string('city');    // المدينة
            $table->string('area');    // المنطقة
            $table->decimal('delivery_fee', 8, 2); // سعر رسوم التوصيل (مثال: 12.60)
            $table->boolean('has_market')->default(false); // جديد: لتخزين ما إذا كان الشيف يملك متجراً
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_locations');
    }
};
