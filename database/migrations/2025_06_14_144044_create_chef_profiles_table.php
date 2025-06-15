<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChefProfilesTable extends Migration
{
    public function up()
    {
        Schema::create('chef_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('country')->nullable();
            $table->text('bio')->nullable();
            $table->enum('contract_type', ['per_recipe', 'annual_subscription'])->nullable();
            $table->text('profit_transfer_details')->nullable();
            $table->string('official_image')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chef_profiles');
    }
}
