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
            // إضافة العمود bookmarked_by من نوع JSON
            $table->json('bookmarked_by')->nullable()->after('video_path');
            $table->json('liked_by')->nullable()->after('bookmarked_by');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('snaps', function (Blueprint $table) {
            $table->dropColumn('bookmarked_by');
        });
    }
};
