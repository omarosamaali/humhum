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
        Schema::table('challenges', function (Blueprint $table) {
            // إضافة الأعمدة الثلاثة مع قيم افتراضية
            $table->unsignedBigInteger('views')->default(0);
            $table->unsignedBigInteger('likes')->default(0);
            $table->unsignedBigInteger('bookmarks')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('challenges', function (Blueprint $table) {
            // حذف الأعمدة في حالة التراجع عن الترحيل
            $table->dropColumn('views');
            $table->dropColumn('likes');
            $table->dropColumn('bookmarks');
        });
    }
};
