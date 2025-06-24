<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB; // Make sure to include this
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // IMPORTANT: MySQL's ALTER TABLE MODIFY COLUMN ENUM can be tricky with existing data.
        // A safer approach is to change to a temporary string, then to the new enum.
        // Or, more simply, use raw SQL for ENUM modification if you're careful.

        DB::statement("ALTER TABLE users MODIFY COLUMN status ENUM('فعال', 'غير فعال', 'بانتظار التفعيل', 'بإنتظار إستكمال البيانات') NOT NULL DEFAULT 'فعال'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert by removing the new value.
        // Be very careful with this in production, as it can cause issues
        // if records already have the 'بإنتظار إستكمال البيانات' status.
        // You might need to update existing records before running down.
        DB::statement("ALTER TABLE users MODIFY COLUMN status ENUM('فعال', 'غير فعال', 'بانتظار التفعيل') NOT NULL DEFAULT 'فعال'");
    }
};