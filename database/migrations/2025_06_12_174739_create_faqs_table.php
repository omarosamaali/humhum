<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question_ar');
            $table->text('answer_ar');
            $table->string('question_en')->nullable();
            $table->text('answer_en')->nullable();
            $table->string('question_id')->nullable();
            $table->text('answer_id')->nullable();
            $table->string('question_am')->nullable();
            $table->text('answer_am')->nullable();
            $table->string('question_hi')->nullable();
            $table->text('answer_hi')->nullable();
            $table->string('question_bn')->nullable();
            $table->text('answer_bn')->nullable();
            $table->string('question_ml')->nullable();
            $table->text('answer_ml')->nullable();
            $table->string('question_fil')->nullable();
            $table->text('answer_fil')->nullable();
            $table->string('question_ur')->nullable();
            $table->text('answer_ur')->nullable();
            $table->string('question_ta')->nullable();
            $table->text('answer_ta')->nullable();
            $table->string('question_ne')->nullable();
            $table->text('answer_ne')->nullable();
            $table->string('question_ps')->nullable();
            $table->text('answer_ps')->nullable();
            $table->boolean('status')->default(1);
            $table->integer('order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};
