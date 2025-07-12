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
            // نتحقق الأول لو العمود مش موجود عشان لو الـ migration اتنفذ قبل كده
            if (!Schema::hasColumn('recipes', 'status')) {
                // إضافة عمود status كـ integer
                $table->integer('status')
                    ->default(1) // القيمة الافتراضية 1 (active)
                    ->after('id'); // ممكن تحطها بعد أي عمود تاني زي ما تحب
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            // عند الرجوع عن الـ migration (rollback)، بنحذف العمود
            if (Schema::hasColumn('recipes', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
