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
        Schema::create('my_family', function (Blueprint $table) {
            $table->id();
            $table->string('avatar')->nullable();
            $table->string('name');
            $table->string('language');
            $table->enum('send_notification', ['1', '0'])->default('0')->nullable();
            $table->enum('has_email', ['1', '0'])->default('0')->nullable();;
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('family_number')->nullable();
            $table->string('password')->nullable();
            $table->string('owner');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_family');
    }
};
