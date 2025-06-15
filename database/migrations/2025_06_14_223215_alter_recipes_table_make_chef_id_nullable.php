<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterRecipesTableMakeChefIdNullable extends Migration
{
    public function up()
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->unsignedBigInteger('chef_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->unsignedBigInteger('chef_id')->nullable(false)->change();
        });
    }
}
