<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('challenges', function (Blueprint $table) {
            // الخطوة 1: حذف العمود القديم 'recipe' إذا كان موجودًا
            // تأكد أنك لا تحتاج إلى نقل البيانات من هذا العمود قبل حذفه
            if (Schema::hasColumn('challenges', 'recipe')) {
                $table->dropColumn('recipe');
            }

            // الخطوة 2: إضافة العمود الجديد 'recipe_id' كمفتاح خارجي
            $table->foreignId('recipe_id') // ينشئ عمود unsignedBigInteger
                ->nullable()           // يجعل العمود يقبل قيم NULL (إذا كان التحدي لا يشترط وصفة)
                ->constrained('recipes') // يربطه بجدول 'recipes' (بافتراض وجوده)
                ->onDelete('set null')  // عند حذف وصفة، يتم تعيين 'recipe_id' في التحدي إلى NULL
                ->after('end_time'); // يمكنك تغيير هذا لتحديد مكان العمود الجديد

            // إذا كنت تريد أن يكون عمود السعر بعد عمود recipe_id
            // يجب إعادة تعريف ترتيبه أو تركه كما هو إذا كان لا يهمك الترتيب
            // $table->decimal('price', 8, 2)->nullable()->after('recipe_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('challenges', function (Blueprint $table) {
            // عكس التغييرات:
            // 1. حذف قيد المفتاح الخارجي أولاً
            $table->dropForeign(['recipe_id']);
            // 2. حذف عمود 'recipe_id'
            $table->dropColumn('recipe_id');

            // 3. (اختياري) إذا كنت تريد إعادة العمود القديم 'recipe' إذا قمت بحذفه في up()
            // هذا لضمان أن عملية down() تعكس up() تمامًا
            $table->string('recipe', 100)->nullable()->after('end_time');
        });
    }
};
