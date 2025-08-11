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
Schema::create('challenge_review_messages', function (Blueprint $table) {
    $table->id();
    $table->foreignId('challenge_review_id')->constrained()->onDelete('cascade');
    $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
    $table->text('message');
    $table->boolean('is_read')->default(false);
    $table->timestamps();
    
    $table->index(['challenge_review_id', 'created_at']);
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challenge_review_messages');
    }
};
