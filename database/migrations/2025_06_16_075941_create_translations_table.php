<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained()->onDelete('cascade');
            $table->string('language_code', 10);
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->json('ingredients')->nullable();
            $table->text('instructions')->nullable();
            $table->timestamps();

            $table->unique(['recipe_id', 'language_code']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('translations');
    }
}
