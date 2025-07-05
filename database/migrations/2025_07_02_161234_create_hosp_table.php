<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hosp', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar')->unique();
            $table->string('title_id')->nullable();
            $table->string('title_am')->nullable();
            $table->string('title_hi')->nullable();
            $table->string('title_bn')->nullable();
            $table->string('title_ml')->nullable();
            $table->string('title_fil')->nullable();
            $table->string('title_ur')->nullable();
            $table->string('title_ta')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_ne')->nullable();
            $table->string('title_ps')->nullable();
            $table->text('description_ar');
            $table->text('description_id')->nullable();
            $table->text('description_am')->nullable();
            $table->text('description_hi')->nullable();
            $table->text('description_bn')->nullable();
            $table->text('description_ml')->nullable();
            $table->text('description_fil')->nullable();
            $table->text('description_ur')->nullable();
            $table->text('description_ta')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_ne')->nullable();
            $table->text('description_ps')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hosp');
    }
};
