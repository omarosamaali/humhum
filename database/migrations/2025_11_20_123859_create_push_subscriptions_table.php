<?php

// database/migrations/YYYY_MM_DD_HHMMSS_create_push_subscriptions_table.php

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
        Schema::create('push_subscriptions', function (Blueprint $table) {
            $table->id();

            // 1. ربط المستخدم: يربط الاشتراك بالمستخدم الذي وافق عليه
            $table->foreignId('user_id')
                  ->constrained() // يتطلب وجود جدول users
                  ->onDelete('cascade'); // حذف الاشتراك بحذف المستخدم

            // 2. نقطة النهاية (Endpoint): عنوان URL الفريد الذي تستخدمه خدمة Push
            $table->string('endpoint', 500)->unique();
            
            // 3. المفتاح العام (Public Key): جزء من مفتاح التشفير المشترك
            $table->string('public_key')->nullable();
            
            // 4. رمز التوثيق (Auth Token): رمز توثيق إضافي لعملية التشفير
            $table->string('auth_token')->nullable();

            // 5. ترميز المحتوى (Content Encoding): يستخدم لتحديد طريقة ترميز البيانات
            $table->string('content_encoding')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('push_subscriptions');
    }
};