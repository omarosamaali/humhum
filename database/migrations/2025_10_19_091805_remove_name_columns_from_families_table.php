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
        Schema::table('families', function (Blueprint $table) {
            $table->dropColumn([
                'name_ar',
                'name_id',
                'name_am',
                'name_hi',
                'name_bn',
                'name_ml',
                'name_fil',
                'name_ur',
                'name_ta',
                'name_en',
                'name_ne',
                'name_ps',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('families', function (Blueprint $table) {
            $table->string('name_ar')->comment('اسم صور العائلة باللغة العربية');
            $table->string('name_id')->nullable()->comment('اسم صور العائلة بالإندونيسية');
            $table->string('name_am')->nullable()->comment('اسم صور العائلة بالأمهرية');
            $table->string('name_hi')->nullable()->comment('اسم صور العائلة بالهندية');
            $table->string('name_bn')->nullable()->comment('اسم صور العائلة بالبنغالية');
            $table->string('name_ml')->nullable()->comment('اسم صور العائلة بالمالايالامية');
            $table->string('name_fil')->nullable()->comment('اسم صور العائلة بالفلبينية');
            $table->string('name_ur')->nullable()->comment('اسم صور العائلة بالأردية');
            $table->string('name_ta')->nullable()->comment('اسم صور العائلة بالتاميلية');
            $table->string('name_en')->nullable()->comment('اسم صور العائلة بالإنجليزية');
            $table->string('name_ne')->nullable()->comment('اسم صور العائلة بالنيبالية');
            $table->string('name_ps')->nullable()->comment('اسم صور العائلة بالأفغانية');
        });
    }
};
