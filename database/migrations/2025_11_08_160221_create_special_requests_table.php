<?php

// database/migrations/xxxx_xx_xx_create_special_requests_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('special_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('recipe_id')->constrained()->onDelete('cascade');
            $table->foreignId('cook_id')->nullable()->constrained('cooks')->onDelete('cascade');
            $table->foreignId('family_member_id')->nullable()->constrained('my_family')->onDelete('cascade');
            $table->enum('meal_type', ['breakfast', 'lunch', 'dinner']);
            $table->integer('guests_count')->default(0);
            $table->date('date');
            $table->time('time');
            $table->timestamps();
            $table->index(['user_id', 'date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('special_requests');
    }
};