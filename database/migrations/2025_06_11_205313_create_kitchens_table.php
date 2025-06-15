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
        Schema::create('kitchens', function (Blueprint $table) { // <--- هنا التغيير
            $table->id();
            $table->string('name_ar')->comment('اسم المطبخ باللغة العربية');
            // أعمدة للغات المترجمة
            $table->string('name_id')->nullable()->comment('اسم المطبخ بالإندونيسية');
            $table->string('name_am')->nullable()->comment('اسم المطبخ بالأمهرية');
            $table->string('name_hi')->nullable()->comment('اسم المطبخ بالهندية');
            $table->string('name_bn')->nullable()->comment('اسم المطبخ بالبنغالية');
            $table->string('name_ml')->nullable()->comment('اسم المطبخ بالمالايالامية');
            $table->string('name_fil')->nullable()->comment('اسم المطبخ بالفلبينية');
            $table->string('name_ur')->nullable()->comment('اسم المطبخ بالأردية');
            $table->string('name_ta')->nullable()->comment('اسم المطبخ بالتاميلية');
            $table->string('name_en')->nullable()->comment('اسم المطبخ بالإنجليزية');
            $table->string('name_ne')->nullable()->comment('اسم المطبخ بالنيبالية');
            $table->string('name_ps')->nullable()->comment('اسم المطبخ بالأفغانية');

            $table->string('image')->nullable()->comment('مسار صورة المطبخ');
            $table->boolean('status')->default(1)->comment('حالة المطبخ (1: فعال, 0: غير فعال)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kitchens'); // <--- وهنا التغيير
    }
};
