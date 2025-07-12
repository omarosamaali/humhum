<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // إضافة DB Facade

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // الخطوة الأولى: تحديث البيانات الحالية
        // قبل ما نغير نوع العمود من INT لـ ENUM
        // لو عندك قيم رقمية (0, 1) محتاج تحولها لنصوص مقابلة
        // لو 0 تعني 'inactive' و 1 تعني 'active'
        DB::table('users')
            ->where('status', 0)
            ->update(['status' => 'inactive']);

        DB::table('users')
            ->where('status', 1)
            ->update(['status' => 'active']);

        Schema::table('users', function (Blueprint $table) {
            // الخطوة الثانية: تغيير نوع العمود 'status' إلى ENUM
            // مع القيم المسموح بها في الكود بتاعك
            $table->enum('status', ['فعال', 'غير فعال', 'بانتظار التفعيل', 'محذوف'])->default('فعال')
                ->default('active')
                ->change(); // ضروري جداً
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // عند الرجوع، نرجعه إلى integer لو كان هو النوع الأصلي
            // أو حسب احتياجك للـ rollback
            $table->integer('status')->change();
        });
    }
};
