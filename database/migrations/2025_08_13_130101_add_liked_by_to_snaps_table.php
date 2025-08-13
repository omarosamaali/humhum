<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // ... inside your migration file

    public function up()
    {
        Schema::table('snaps', function (Blueprint $table) {
            $table->json('liked_by')->nullable();
        });
    }

    public function down()
    {
        Schema::table('snaps', function (Blueprint $table) {
            $table->dropColumn('liked_by');
        });
    }

    // ...
};
