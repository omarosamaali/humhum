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
        DB::statement("ALTER TABLE messages MODIFY COLUMN status ENUM('unread', 'opened', 'replied', 'closed') NOT NULL DEFAULT 'unread'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE messages MODIFY COLUMN status ENUM('unread', 'opened', 'replied') NOT NULL DEFAULT 'unread'");
    }
};
