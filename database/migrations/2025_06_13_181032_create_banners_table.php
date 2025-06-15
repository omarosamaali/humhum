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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('image'); // مسار الصورة
            $table->dateTime('start_date')->nullable(); // وقت بدء العرض
            $table->dateTime('end_date')->nullable();   // وقت انتهاء العرض
            $table->enum('display_location', ['website', 'mobile_app'])->default('website'); // مكان العرض
            $table->boolean('status')->default(true); // حالة البانر (فعال/غير فعال)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
