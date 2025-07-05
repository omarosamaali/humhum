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
            $table->string('status_temp')->nullable()->after('status');
        });

        DB::table('users')->update([
            'status_temp' => DB::raw("CASE WHEN status = 1 THEN 'فعال' WHEN status = 0 THEN 'غير فعال' ELSE 'بانتظار التفعيل' END")
        ]);

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->enum('status', ['فعال', 'غير فعال', 'بانتظار التفعيل'])->default('فعال')->after('status_temp');
        });

        DB::table('users')->update([
            'status' => DB::raw('status_temp')
        ]);

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status_temp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('status')->default(1)->change();
        });
    }
};
