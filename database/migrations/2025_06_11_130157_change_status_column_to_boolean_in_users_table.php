<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // $table->boolean('is_active')->default(true)->after('status');
        });

        // DB::table('users')->where('status', 'فعال')->update(['is_active' => true]);
        // DB::table('users')->where('status', 'غير فعال')->update(['is_active' => false]);

        Schema::table('users', function (Blueprint $table) {
            // $table->dropColumn('status');
        });

        Schema::table('users', function (Blueprint $table) {
            // $table->renameColumn('is_active', 'status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('old_status')->default('فعال')->after('status');
        });

        DB::table('users')->where('status', true)->update(['old_status' => 'فعال']);
        DB::table('users')->where('status', false)->update(['old_status' => 'غير فعال']);

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('old_status', 'status');
        });
    }
};
