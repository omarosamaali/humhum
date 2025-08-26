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
        Schema::table('snaps', function (Blueprint $table) {
            // إضافة عمود likes مع قيمة افتراضية 0
            $table->integer('likes')->default(0)->after('user_id');

            // أو لو عايز unsigned integer
            // $table->unsignedInteger('likes')->default(0)->after('user_id');

            // أو لو عايز big integer للأرقام الكبيرة
            // $table->unsignedBigInteger('likes')->default(0)->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('snaps', function (Blueprint $table) {
            $table->dropColumn('likes');
        });
    }
};
