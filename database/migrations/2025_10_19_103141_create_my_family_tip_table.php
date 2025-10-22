<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('my_family_tip', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('my_family_id');
            $table->unsignedBigInteger('tip_id')->nullable();
            $table->string('custom_tip')->nullable();
            $table->timestamps();

            // تصحيح اسم الجدول من my_families إلى my_family
            $table->foreign('my_family_id')
                ->references('id')
                ->on('my_family')  // ← هنا التعديل
                ->onDelete('cascade');

            $table->foreign('tip_id')
                ->references('id')
                ->on('tips')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('my_family_tip');
    }
};
