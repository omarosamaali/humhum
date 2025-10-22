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
        Schema::table('users', function (Blueprint $table) {
            $table->string('status', 20)->change()->default('بانتظار التفعيل');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Revert the changes if needed. This might be tricky if you originally had an ENUM.
            // If it was an ENUM, you'd need to define the old ENUM values here.
            // For a simpler rollback, consider keeping it as VARCHAR or restoring specific ENUM values.
            $table->string('status', 10)->change(); // Assuming original length was 10 or less
        });
    }
};
