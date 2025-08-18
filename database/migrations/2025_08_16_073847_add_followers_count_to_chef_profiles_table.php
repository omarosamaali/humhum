<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('chef_profiles', function (Blueprint $table) {
            $table->unsignedBigInteger('followers_count')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('chef_profiles', function (Blueprint $table) {
            $table->dropColumn('followers_count');
        });
    }
};
