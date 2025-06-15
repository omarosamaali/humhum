<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // لإضافة DB facade

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // الخطوة 1: إضافة عمود مؤقت من نوع boolean
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('status');
        });

        // الخطوة 2: تحديث القيم في العمود الجديد بناءً على العمود القديم
        DB::table('users')->where('status', 'فعال')->update(['is_active' => true]);
        DB::table('users')->where('status', 'غير فعال')->update(['is_active' => false]);

        // الخطوة 3: حذف العمود القديم
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        // الخطوة 4: إعادة تسمية العمود الجديد إلى 'status'
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('is_active', 'status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // لعملية التراجع:
        // الخطوة 1: إضافة عمود مؤقت من نوع string
        Schema::table('users', function (Blueprint $table) {
            $table->string('old_status')->default('فعال')->after('status');
        });

        // الخطوة 2: تحديث القيم في العمود الجديد بناءً على العمود الحالي
        DB::table('users')->where('status', true)->update(['old_status' => 'فعال']);
        DB::table('users')->where('status', false)->update(['old_status' => 'غير فعال']);

        // الخطوة 3: حذف العمود الحالي (الـ boolean)
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        // الخطوة 4: إعادة تسمية العمود المؤقت إلى 'status'
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('old_status', 'status');
        });
    }
};
