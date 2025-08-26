<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('snaps', function (Blueprint $table) {
            $table->integer('bookmarks')->default(0)->after('likes');
        });
    }

    public function down(): void
    {
        Schema::table('snaps', function (Blueprint $table) {
            $table->dropColumn('bookmarks');
        });
    }
};