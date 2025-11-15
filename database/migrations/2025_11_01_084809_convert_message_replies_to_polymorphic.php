<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('message_replies', function (Blueprint $table) {
            // إزالة الـ Foreign Key القديم
            $table->dropForeign(['message_id']);

            // تغيير message_id إلى messageable_id
            $table->renameColumn('message_id', 'messageable_id');

            // إضافة messageable_type
            $table->string('messageable_type')->after('id');

            // إضافة index للأداء
            $table->index(['messageable_id', 'messageable_type']);
        });
    }

    public function down()
    {
        Schema::table('message_replies', function (Blueprint $table) {
            $table->dropIndex(['messageable_id', 'messageable_type']);
            $table->dropColumn('messageable_type');
            $table->renameColumn('messageable_id', 'message_id');
            $table->foreign('message_id')->references('id')->on('messages')->onDelete('cascade');
        });
    }
};
