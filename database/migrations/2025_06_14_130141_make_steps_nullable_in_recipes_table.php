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
        Schema::table('recipes', function (Blueprint $table) {
            // لو عمود 'steps' نوعه JSON في قاعدة البيانات:
            $table->json('steps')->nullable()->change();
            // لو عمود 'steps' نوعه TEXT في قاعدة البيانات (أو LongText):
            // $table->text('steps')->nullable()->change(); // أو $table->longText('steps')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            // لو عمود 'steps' نوعه JSON:
            $table->json('steps')->nullable(false)->change();
            // لو عمود 'steps' نوعه TEXT:
            // $table->text('steps')->nullable(false)->change(); // أو $table->longText('steps')->nullable(false)->change();
        });
    }
};
