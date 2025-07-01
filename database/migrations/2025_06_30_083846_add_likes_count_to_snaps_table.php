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
            // إضافة عمود likes_count بعد عمود recipe_id (يمكنك اختيار مكانه)
            $table->unsignedInteger('likes_count')->default(0)->after('recipe_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('snaps', function (Blueprint $table) {
            // إزالة عمود likes_count عند التراجع عن الـ migration
            $table->dropColumn('likes_count');
        });
    }
};
