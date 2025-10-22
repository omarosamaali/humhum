<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IncreaseStatusColumnLengthInUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('status', 255)->change()->default('بانتظار التفعيل'); // Increase to 255 characters
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('status', 50)->change(); // Revert to original length
        });
    }
}
