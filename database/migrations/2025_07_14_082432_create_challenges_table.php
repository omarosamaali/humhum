<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('challenges', function (Blueprint $table) {
            $table->id();
            $table->string('announcement_path')->nullable(); // Path to uploaded file
            $table->text('message')->nullable(); // Message to users
            $table->date('start_date')->nullable(); // Start date
            $table->time('start_time')->nullable(); // Start time
            $table->date('end_date')->nullable(); // End date
            $table->time('end_time')->nullable(); // End time
            $table->string('recipe', 100)->nullable(); // Selected recipe
            $table->decimal('price', 8, 2)->nullable(); // Recipe price
            $table->enum('challenge_type', ['users', 'chefs'])->default('users'); // Challenge type
            $table->enum('status', ['active', 'inactive'])->default('active'); // Challenge status
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('challenges');
    }
};
