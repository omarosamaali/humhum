// database/migrations/create_challenge_reviews_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('challenge_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('challenge_response_id')->constrained()->onDelete('cascade');
            $table->foreignId('chef_id')->constrained('users')->onDelete('cascade');
            $table->integer('rating')->unsigned()->comment('من 1 إلى 5');
            $table->text('chef_message_response')->nullable();
            $table->timestamps();

            $table->unique(['challenge_response_id', 'chef_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('challenge_reviews');
    }
};
