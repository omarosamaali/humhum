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
        Schema::table('products', function (Blueprint $table) {
            // إضافة العمود is_active كـ boolean بقيمة افتراضية true
            // بعد العمود 'type' (اختياري لتحديد الترتيب)
            $table->boolean('is_active')->default(true)->after('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // حذف العمود is_active عند التراجع عن الهجرة
            $table->dropColumn('is_active');
        });
    }
};
