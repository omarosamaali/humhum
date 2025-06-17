<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('chef_profiles', function (Blueprint $table) {
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->string('name_id')->nullable();
            $table->string('name_am')->nullable();
            $table->string('name_hi')->nullable();
            $table->string('name_bn')->nullable();
            $table->string('name_ml')->nullable();
            $table->string('name_fil')->nullable();
            $table->string('name_ur')->nullable();
            $table->string('name_ta')->nullable();
            $table->string('name_ps')->nullable();
            $table->string('name')->nullable();
        });
    }

    public function down()
    {
        Schema::table('chef_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'name_ar',
                'name_en',
                'name_id',
                'name_am',
                'name_hi',
                'name_bn',
                'name_ml',
                'name_fil',
                'name_ur',
                'name_ta',
                'name_ps',
                'name'
            ]);
        });
    }
};
