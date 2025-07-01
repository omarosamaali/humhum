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
        Schema::create('likes', function (Blueprint $table) {
            $table->id(); // عمود ID فريد لكل إعجاب
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // مفتاح خارجي لجدول المستخدمين (users)
            $table->foreignId('snap_id')->constrained('snaps')->onDelete('cascade'); // مفتاح خارجي لجدول المقاطع (snaps)
            $table->timestamps(); // عمودين created_at و updated_at لتتبع وقت الإعجاب

            // لضمان أن المستخدم الواحد لا يمكنه الإعجاب بنفس المقطع أكثر من مرة
            $table->unique(['user_id', 'snap_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
