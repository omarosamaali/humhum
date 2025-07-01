<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // إضافة هذه المكتبة

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // الطريقة الموصى بها لتعديل عمود ENUM في MySQL
        // ALTER TABLE messages MODIFY COLUMN status ENUM('unread', 'opened', 'replied', 'closed') NOT NULL DEFAULT 'unread';

        // الطريقة الأولى: استخدام DB::statement (تعمل جيدًا مع MySQL)
        // هذه الطريقة تقوم بتعديل تعريف العمود مباشرة في SQL
        DB::statement("ALTER TABLE messages MODIFY COLUMN status ENUM('unread', 'opened', 'replied', 'closed') NOT NULL DEFAULT 'unread'");

        // الطريقة الثانية: (Laravel 10+)
        // هذه الطريقة أصبحت مدعومة بشكل أفضل في Laravel 10 وما فوق
        // Schema::table('messages', function (Blueprint $table) {
        //     $table->enum('status', ['unread', 'opened', 'replied', 'closed'])->default('unread')->change();
        // });

        // ملاحظة: إذا كنت تستخدم SQLite لتطويرك المحلي، فإن SQLite لا يدعم تعديل أعمدة ENUM بشكل مباشر.
        // ستحتاج إلى حل بديل لـ SQLite مثل إعادة إنشاء الجدول أو استخدام نص SQL خام.
        // ولكن بالنسبة لـ MySQL (الخادم الفعلي)، فإن DB::statement يعمل بشكل ممتاز.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // عند التراجع عن المايجريشن، يجب أن تعكس التغيير
        // إذا قمت بإضافة 'closed'، فعند التراجع يجب إزالته
        DB::statement("ALTER TABLE messages MODIFY COLUMN status ENUM('unread', 'opened', 'replied') NOT NULL DEFAULT 'unread'");
        // أو
        // Schema::table('messages', function (Blueprint $table) {
        //     $table->enum('status', ['unread', 'opened', 'replied'])->default('unread')->change();
        // });
    }
};
