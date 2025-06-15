<?php

// database/migrations/YYYY_MM_DD_HHMMSS_change_steps_column_to_json_in_recipes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // إضافة هذه السطر

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            // قم بتغيير العمود إلى JSON
            // ملاحظة: هذا قد يتطلب بعض التحويل اليدوي للبيانات الموجودة إذا لم تكن بالفعل JSON صالحًا.
            // لـ MySQL 8+ أو PostgreSQL، يمكنك استخدام change()
            $table->json('steps')->nullable()->change();

            // إذا كنت تستخدم MySQL < 8 أو SQLite، قد تحتاج إلى حلول بديلة (إعادة إنشاء العمود أو استخدام DB raw)
            // مثال لـ MySQL < 8:
            // $table->text('steps')->nullable()->change(); // أو أعده إلى text إذا لم تدعم قاعدة البيانات JSON
            // أو استخدم DB::statement
            // DB::statement('ALTER TABLE recipes MODIFY COLUMN steps JSON');
        });
    }

    public function down(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            // عند التراجع، أعده إلى النوع الأصلي إذا لزم الأمر
            $table->longText('steps')->nullable()->change();
        });
    }
};