<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('challenge_reviews', function (Blueprint $table) {
            $table->unsignedBigInteger('sender_id')->after('chef_id');
            $table->foreign('sender_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::table('challenge_reviews', function (Blueprint $table) {
            $table->dropForeign(['sender_id']);
            $table->dropColumn('sender_id');
        });
    }
};
