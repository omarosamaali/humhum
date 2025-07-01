<?php

// database/migrations/2025_06_30_095302_change_sub_category_id_to_json_in_snaps_table.php

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
        Schema::table('snaps', function (Blueprint $table) {
            // الخطوة 1: إزالة المفتاح الخارجي الموجود أولاً
            // اسم المفتاح الخارجي عادة ما يكون اسم الجدول + اسم العمود + _foreign
            // لذا، غالباً سيكون 'snaps_sub_category_id_foreign'
            // تأكد من الاسم الدقيق للمفتاح الخارجي من رسالة الخطأ أو من phpMyAdmin
            $table->dropForeign(['sub_category_id']);

            // الخطوة 2: الآن قم بتغيير نوع العمود إلى JSON
            $table->json('sub_category_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('snaps', function (Blueprint $table) {
            // في حالة التراجع (rollback):
            // 1. إعادة نوع العمود إلى حالته الأصلية (على الأرجح integer)
            $table->integer('sub_category_id')->nullable()->change();
            // 2. إعادة المفتاح الخارجي إذا كنت لا تزال تخطط لاستخدامه كعلاقة One-to-Many
            //    ولكن بما أننا نتحول لـ Many-to-Many، فغالباً لن تعيده.
            //    إذا أردت إعادته لأغراض الـ rollback فقط وكان هذا هو التصميم الأصلي:
            // $table->foreign('sub_category_id')->references('id')->on('sub_categories')->onDelete('cascade');
        });
    }
};