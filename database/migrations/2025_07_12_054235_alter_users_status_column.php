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
            // Change 'your_current_type' to the actual type if it's not string
            // For example, if it's an ENUM, you might need to drop and re-add.
            // A simpler approach is to ensure it's a string and then modifyLength
            $table->string('status', 20)->change(); // Change 20 to a suitable length
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
