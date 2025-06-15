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
        Schema::create('main_categories', function (Blueprint $table) { // <--- هنا التغيير
            $table->id();
            $table->string('name_ar')->comment('اسم التصنيف الرئيسي باللغة العربية');
            // أعمدة للغات المترجمة
            $table->string('name_id')->nullable()->comment('اسم التصنيف الرئيسي بالإندونيسية');
            $table->string('name_am')->nullable()->comment('اسم التصنيف الرئيسي بالأمهرية');
            $table->string('name_hi')->nullable()->comment('اسم التصنيف الرئيسي بالهندية');
            $table->string('name_bn')->nullable()->comment('اسم التصنيف الرئيسي بالبنغالية');
            $table->string('name_ml')->nullable()->comment('اسم التصنيف الرئيسي بالمالايالامية');
            $table->string('name_fil')->nullable()->comment('اسم التصنيف الرئيسي بالفلبينية');
            $table->string('name_ur')->nullable()->comment('اسم التصنيف الرئيسي بالأردية');
            $table->string('name_ta')->nullable()->comment('اسم التصنيف الرئيسي بالتاميلية');
            $table->string('name_en')->nullable()->comment('اسم التصنيف الرئيسي بالإنجليزية');
            $table->string('name_ne')->nullable()->comment('اسم التصنيف الرئيسي بالنيبالية');
            $table->string('name_ps')->nullable()->comment('اسم التصنيف الرئيسي بالأفغانية');

            $table->string('image')->nullable()->comment('مسار صورة التصنيف الرئيسي');
            $table->boolean('status')->default(1)->comment('حالة التصنيف الرئيسي (1: فعال, 0: غير فعال)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_categories'); // <--- وهنا التغيير
    }
};
