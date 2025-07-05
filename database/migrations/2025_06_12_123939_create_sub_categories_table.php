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
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('main_categories')->onDelete('cascade');
            $table->string('name_ar')->comment('اسم التصنيف الفرعي باللغة العربية');
            $table->string('name_en')->nullable()->comment('اسم التصنيف الفرعي بالإنجليزية');
            $table->string('name_id')->nullable()->comment('اسم التصنيف الفرعي بالإندونيسية');
            $table->string('name_am')->nullable()->comment('اسم التصنيف الفرعي بالأمهرية');
            $table->string('name_hi')->nullable()->comment('اسم التصنيف الفرعي بالهندية');
            $table->string('name_bn')->nullable()->comment('اسم التصنيف الفرعي بالبنغالية');
            $table->string('name_ml')->nullable()->comment('اسم التصنيف الفرعي بالمالايالامية');
            $table->string('name_fil')->nullable()->comment('اسم التصنيف الفرعي بالفلبينية');
            $table->string('name_ur')->nullable()->comment('اسم التصنيف الفرعي بالأردية');
            $table->string('name_ta')->nullable()->comment('اسم التصنيف الفرعي بالتاميلية');
            $table->string('name_ne')->nullable()->comment('اسم التصنيف الفرعي بالنيبالية');
            $table->string('name_ps')->nullable()->comment('اسم التصنيف الفرعي بالبشتو');
            $table->boolean('status')->default(0)->comment('حالة التصنيف الفرعي (0: فعال, 1: غير فعال)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_categories');
    }
};