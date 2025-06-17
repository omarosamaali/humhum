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
            // أضف أعمدة للغات المختلفة.
            // يمكنك اختيار وضعها بعد عمود 'name' أو في نهاية الجدول.
            // هنا سأضعها بعد 'name' لمزيد من التنظيم.
            $table->string('name_ar')->nullable()->after('name'); // العربية
            $table->string('name_en')->nullable()->after('name_ar'); // الإنجليزية
            $table->string('name_id')->nullable()->after('name_en'); // الإندونيسية
            $table->string('name_am')->nullable()->after('name_id'); // الأمهرية
            $table->string('name_hi')->nullable()->after('name_am'); // الهندية
            $table->string('name_bn')->nullable()->after('name_hi'); // البنغالية
            $table->string('name_ml')->nullable()->after('name_bn'); // الماليالامية
            $table->string('name_fil')->nullable()->after('name_ml'); // الفلبينية
            $table->string('name_ur')->nullable()->after('name_fil'); // الأردية
            $table->string('name_ta')->nullable()->after('name_ur'); // التاميلية
            $table->string('name_ps')->nullable()->after('name_ta'); // الباشتو
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // إزالة الأعمدة عند التراجع عن الهجرة
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
