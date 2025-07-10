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
            // إضافة العمود digital_file_path كـ string (مسار الملف) وقابلية للقيمة Null
            $table->string('digital_file_path')->nullable()->after('image_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // حذف العمود digital_file_path عند التراجع عن الهجرة
            $table->dropColumn('digital_file_path');
        });
    }
};
