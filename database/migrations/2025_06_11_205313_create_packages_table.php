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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar')->comment('اسم الباقة باللغة العربية');
            $table->string('name_id')->nullable()->comment('اسم الباقة بالإندونيسية');
            $table->string('name_am')->nullable()->comment('اسم الباقة بالأمهرية');
            $table->string('name_hi')->nullable()->comment('اسم الباقة بالهندية');
            $table->string('name_bn')->nullable()->comment('اسم الباقة بالبنغالية');
            $table->string('name_ml')->nullable()->comment('اسم الباقة بالمالايالامية');
            $table->string('name_fil')->nullable()->comment('اسم الباقة بالفلبينية');
            $table->string('name_ur')->nullable()->comment('اسم الباقة بالأردية');
            $table->string('name_ta')->nullable()->comment('اسم الباقة بالتاميلية');
            $table->string('name_en')->nullable()->comment('اسم الباقة بالإنجليزية');
            $table->string('name_ne')->nullable()->comment('اسم الباقة بالنيبالية');
            $table->string('name_ps')->nullable()->comment('اسم الباقة بالأفغانية');
            $table->string('image')->nullable()->comment('مسار صورة الباقة');
            $table->boolean('status')->default(1)->comment('حالة الباقة (1: فعال, 0: غير فعال)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
