<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('special_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
            $table->unsignedBigInteger('family_user_id')->nullable()->after('user_id');
            $table->foreign('family_user_id')->references('id')->on('my_family')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('special_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
            $table->dropForeign(['family_user_id']);
            $table->dropColumn('family_user_id');
        });
    }
};
