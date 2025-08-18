<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chef_profile_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('chef_profile_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->unique(['user_id', 'chef_profile_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chef_profile_user');
    }
};
