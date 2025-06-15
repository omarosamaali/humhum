<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipeStepsTable extends Migration
{
    public function up()
    {
        Schema::create('recipe_steps', function (Blueprint $table) {
            $table->id(); // عمود ID تلقائي
            $table->foreignId('recipe_id')->constrained()->onDelete('cascade');
            // 'recipe_id' سيرتبط بجدول recipes ويتم حذفه إذا حُذفت الوصفة
            $table->text('step_text'); // نص الخطوة
            $table->json('media')->nullable(); // مسارات وأنواع الوسائط (صور/فيديوهات) كـ JSON
            $table->timestamps(); // created_at و updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('recipe_steps'); // لإزالة الجدول عند التراجع
    }
}
