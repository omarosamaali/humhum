<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hosp', function (Blueprint $table) {
            $table->string('calc_nutrition_image')->nullable()->after('description_ps');
            $table->string('nutrition_label_image')->nullable()->after('calc_nutrition_image');
        });
    }

    public function down(): void
    {
        Schema::table('hosp', function (Blueprint $table) {
            $table->dropColumn('calc_nutrition_image');
            $table->dropColumn('nutrition_label_image');
        });
    }
};
