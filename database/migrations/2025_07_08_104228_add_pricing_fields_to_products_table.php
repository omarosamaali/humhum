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
        Schema::table('products', function (Blueprint $table) {
            // إضافة الأعمدة الجديدة
            $table->decimal('base_price', 8, 2)->after('name'); // السعر الأساسي للمنتج
            $table->decimal('payment_gateway_fee', 8, 2)->default(0.00)->after('base_price'); // رسوم بوابة الدفع، بقيمة افتراضية 0
            $table->decimal('selling_price', 8, 2)->after('payment_gateway_fee'); // سعر البيع النهائي

            // حذف العمود القديم 'price' إذا كان موجودًا
            // تأكد من أنك تريد حذف العمود القديم قبل تنفيذ هذا السطر
            // إذا كنت تريد الاحتفاظ به وتغيير اسمه، استخدم ->renameColumn()
            if (Schema::hasColumn('products', 'price')) {
                $table->dropColumn('price');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // عكس التغييرات: حذف الأعمدة الجديدة
            $table->dropColumn(['base_price', 'payment_gateway_fee', 'selling_price']);

            // إعادة العمود القديم 'price' إذا تم حذفه في الـ up()
            // إذا لم تكن قد حذفته في الـ up()، لا تضف هذا السطر
            $table->decimal('price', 8, 2)->nullable(); // يمكن أن يكون nullable إذا لم يكن له قيمة عند الرجوع
        });
    }
};
