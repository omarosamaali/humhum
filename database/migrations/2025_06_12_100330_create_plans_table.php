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
        Schema::create('plans', function (Blueprint $table) {
            $table->id(); // العمود الأساسي ID

            // العمود لربط الخطة بالباقة
            $table->unsignedBigInteger('package_id');
            // قيد المفتاح الأجنبي لربطه بجدول الباقات، مع خيار الحذف المتتالي (cascade)
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');

            // أعمدة أسماء الخطط باللغات المختلفة (نفس اللغات المستخدمة في packages)
            $table->string('name_ar')->comment('اسم الخطة باللغة العربية');
            $table->string('name_id')->nullable()->comment('اسم الخطة بالإندونيسية');
            $table->string('name_am')->nullable()->comment('اسم الخطة بالأمهرية');
            $table->string('name_hi')->nullable()->comment('اسم الخطة بالهندية');
            $table->string('name_bn')->nullable()->comment('اسم الخطة بالبنغالية');
            $table->string('name_ml')->nullable()->comment('اسم الخطة بالمالايالامية');
            $table->string('name_fil')->nullable()->comment('اسم الخطة بالفلبينية');
            $table->string('name_ur')->nullable()->comment('اسم الخطة بالأردية');
            $table->string('name_ta')->nullable()->comment('اسم الخطة بالتاميلية');
            $table->string('name_en')->nullable()->comment('اسم الخطة بالإنجليزية');
            $table->string('name_ne')->nullable()->comment('اسم الخطة بالنيبالية');
            $table->string('name_ps')->nullable()->comment('اسم الخطة بالبشتو'); // تم التعديل إلى البشتو بناءً على ps

            // عمود السعر
            $table->decimal('price', 8, 2)->comment('سعر الخطة'); // السعر (8 خانات إجمالاً، 2 بعد العلامة العشرية)

            // عمود المدة ووحدتها
            $table->string('duration_unit')->comment('وحدة المدة (شهر، 3 شهور، 6 شهور، 12 شهر)');

            // عمود الحالة (فعال/غير فعال)
            $table->boolean('status')->default(0)->comment('حالة الخطة (0: فعال, 1: غير فعال)'); // 0 للفعال، 1 لغير الفعال، القيمة الافتراضية 0

            $table->timestamps(); // عمودي created_at و updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
