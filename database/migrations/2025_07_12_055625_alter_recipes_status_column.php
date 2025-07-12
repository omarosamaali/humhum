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
        Schema::table('recipes', function (Blueprint $table) {
            // هنخلي نوع العمود integer
            // وهنستخدم default(1) لـ 'active' لو مفيش قيمة
            $table->integer('status')->default(1)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            // لو حبيت ترجع عن الـ migration ده، ممكن ترجعه لنوع String لو كان كده
            // بس غالباً مش هتحتاج دي لو ده النوع الأصلي
            // لو كنت عامله ENUM قبل كده وعايز ترجعله في الـ rollback:
            // $table->enum('status', ['active', 'inactive'])->default('active')->change();
            // الأفضل إنك تسيبه على integer لو ده كان الأصل أو انت عايز ده يكون الأصل
            // بما أنك فضلت الـ 0 والـ 1، فغالباً مش هتحتاج تعمل rollback للـ string أو enum
        });
    }
};
