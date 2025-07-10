<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceToRecipesTable extends Migration
{
    public function up()
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->decimal('price', 8, 2)->nullable()->after('is_free'); // عمود price بدقة 8 أرقام، 2 منها للجزء العشري
        });
    }

    public function down()
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropColumn('price');
        });
    }
}
