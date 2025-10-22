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
        Schema::create('tips', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_id')->nullable();
            $table->string('name_am')->nullable();
            $table->string('name_hi')->nullable();
            $table->string('name_bn')->nullable();
            $table->string('name_ml')->nullable();
            $table->string('name_fil')->nullable();
            $table->string('name_ur')->nullable();
            $table->string('name_ta')->nullable();
            $table->string('name_en')->nullable();
            $table->string('name_ne')->nullable();
            $table->string('name_ps')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tips');
    }
};
