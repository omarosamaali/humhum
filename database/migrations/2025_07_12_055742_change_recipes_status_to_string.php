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
            // أفضل حل: تغيير النوع إلى ENUM (تعداد) بقيم محددة
            // ده هيسمح لك بتخزين 'active' أو 'inactive' فقط
            // وهيمنع أي قيم تانية غلط.
            $table->enum('status', ['active', 'inactive'])->default('active')->change();

            // لو عايز تخليها نص عادي (VARCHAR) بدون قيم محددة:
            // $table->string('status', 20)->default('active')->change();
            // اختر الخيار الأنسب لك (ENUM هو الأفضل هنا).
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            // ده الكود اللي بيرجع التغيير لو عملت rollback
            // محتاج ترجّع نوع العمود للحالة اللي كان عليها قبل التعديل ده.
            // لو كان integer، رجّعه integer.
            $table->integer('status')->change();
        });
    }
};
