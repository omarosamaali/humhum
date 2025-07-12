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
        DB::statement("ALTER TABLE users CHANGE status status ENUM('active', 'inactive', 'cancelled') NOT NULL DEFAULT 'active'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // You might want to handle existing 'cancelled' values before reverting
        // For example, update them to 'inactive' or 'active'
        DB::statement("ALTER TABLE users CHANGE status status ENUM('active', 'inactive') NOT NULL DEFAULT 'active'");
    }
};
