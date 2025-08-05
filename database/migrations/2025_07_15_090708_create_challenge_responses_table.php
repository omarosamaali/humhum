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
        Schema::create('challenge_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('challenge_id')->constrained('challenges')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // افترض أن جدول المستخدمين هو 'users'
            $table->string('recipe_image_path')->nullable();
            $table->string('challenge_video_path')->nullable();
            $table->text('message_to_chef')->nullable();
            $table->string('status')->default('pending'); // 'pending', 'accepted', 'rejected'
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challenge_responses');
    }
};
