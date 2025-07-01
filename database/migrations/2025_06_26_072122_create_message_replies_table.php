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
        Schema::create('message_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('message_id')->constrained('messages')->onDelete('cascade'); // الربط بالرسالة الأصلية
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');     // من أرسل الرد (الادمن أو الطاهي)
            $table->text('content')->nullable();                                         // نص الرد
            $table->string('file_path')->nullable();                                    // مسار المرفق (صورة/فيديو) للرد
            $table->enum('status', ['unread', 'read'])->default('unread');              // حالة قراءة الرد (بالنسبة لمستقبل الرد)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_replies');
    }
};
