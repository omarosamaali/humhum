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
        Schema::table('users', function (Blueprint $table) {
            // تغيير عمود 'role' ليصبح VARCHAR بطول 50 (أو أي طول آخر تراه مناسبًا)
            // يجب أن يكون الطول كافياً لأكبر دور تتوقع إدخاله
            // بعد 'string' يمكنك إضافة 'after' لتحديد مكانه، أو تركه Laravel يضعه في نهاية الجدول
            $table->string('role', 50)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // عند التراجع (rollback)، يمكنك إعادة العمود إلى حجمه الأصلي
            // تأكد من أن الحجم الأصلي يمكنه استيعاب الأدوار القديمة
            $table->string('role', 255)->change(); // افترض أن الطول الأصلي كان 255 أو قم بتعيين الطول الأصلي
        });
    }
};
