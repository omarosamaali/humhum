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
        // تحقق أولاً إذا كان العمود غير موجود قبل إضافته
        // هذا يمنع الأخطاء إذا قمت بتشغيل الـ migration مرة أخرى بطريق الخطأ وكان العمود موجودًا بالفعل
        Schema::table('snaps', function (Blueprint $table) {
            if (!Schema::hasColumn('snaps', 'views')) {
                $table->unsignedInteger('views')->default(0)->after('recipe_id'); // أضف بعد recipe_id أو بعد likes_count
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('snaps', function (Blueprint $table) {
            // تحقق أولاً إذا كان العمود موجودًا قبل حذفه
            if (Schema::hasColumn('snaps', 'views')) {
                $table->dropColumn('views');
            }
        });
    }
};
