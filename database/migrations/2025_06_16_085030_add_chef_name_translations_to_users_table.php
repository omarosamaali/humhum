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
        Schema::table('users', function (Blueprint $table) {
            $table->string('name_ar')->nullable()->after('name');
            $table->string('name_en')->nullable()->after('name_ar');
            $table->string('name_id')->nullable()->after('name_en');
            $table->string('name_am')->nullable()->after('name_id');
            $table->string('name_hi')->nullable()->after('name_am');
            $table->string('name_bn')->nullable()->after('name_hi');
            $table->string('name_ml')->nullable()->after('name_bn');
            $table->string('name_fil')->nullable()->after('name_ml');
            $table->string('name_ur')->nullable()->after('name_fil');
            $table->string('name_ta')->nullable()->after('name_ur');
            $table->string('name_ps')->nullable()->after('name_ta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
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
            ]);
        });
    }
};
