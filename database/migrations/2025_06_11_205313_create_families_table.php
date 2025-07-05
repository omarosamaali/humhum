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
        Schema::create('families', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar')->comment('اسم صور العائلة باللغة العربية');
            $table->string('name_id')->nullable()->comment('اسم صور العائلة بالإندونيسية');
            $table->string('name_am')->nullable()->comment('اسم صور العائلة بالأمهرية');
            $table->string('name_hi')->nullable()->comment('اسم صور العائلة بالهندية');
            $table->string('name_bn')->nullable()->comment('اسم صور العائلة بالبنغالية');
            $table->string('name_ml')->nullable()->comment('اسم صور العائلة بالمالايالامية');
            $table->string('name_fil')->nullable()->comment('اسم صور العائلة بالفلبينية');
            $table->string('name_ur')->nullable()->comment('اسم صور العائلة بالأردية');
            $table->string('name_ta')->nullable()->comment('اسم صور العائلة بالتاميلية');
            $table->string('name_en')->nullable()->comment('اسم صور العائلة بالإنجليزية');
            $table->string('name_ne')->nullable()->comment('اسم صور العائلة بالنيبالية');
            $table->string('name_ps')->nullable()->comment('اسم صور العائلة بالأفغانية');
            $table->string('image')->nullable()->comment('مسار صورة صور العائلة');
            $table->boolean('status')->default(1)->comment('حالة صور العائلة (1: فعال, 0: غير فعال)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('families');
    }
};
