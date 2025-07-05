<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ModifyStepsColumnToJsonInRecipes extends Migration
{
    public function up()
    {
        DB::statement("UPDATE recipes SET steps = CASE WHEN steps IS NULL OR steps = '' THEN '[]' ELSE JSON_ARRAY(REPLACE(steps, '\n', '\",\"')) END WHERE 1=1");
        Schema::table('recipes', function (Blueprint $table) {
            $table->json('steps')->change();
        });
    }

    public function down()
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->longText('steps')->change();
        });
    }
}
