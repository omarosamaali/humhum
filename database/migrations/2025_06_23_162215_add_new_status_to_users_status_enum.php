<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN status ENUM('فعال', 'غير فعال', 'بانتظار التفعيل', 'بإنتظار إستكمال البيانات') NOT NULL DEFAULT 'فعال'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN status ENUM('فعال', 'غير فعال', 'بانتظار التفعيل') NOT NULL DEFAULT 'فعال'");
    }
};