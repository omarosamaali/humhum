<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipe_id',
        'step_text',
        'step_image',
        'step_order'
    ];

    // علاقة الترجمات
    public function translations()
    {
        return $this->morphMany(Translation::class, 'translatable');
    }

    // الحصول على الترجمة للغة معينة
    public function getTranslation($languageCode)
    {
        return $this->translations()->where('language_code', $languageCode)->first();
    }

    // الحصول على نص الخطوة المترجم
    public function getTranslatedStepText($languageCode = null)
    {
        if (!$languageCode) {
            $languageCode = app()->getLocale();
        }

        if ($languageCode === 'ar') {
            return $this->step_text;
        }

        $translation = $this->getTranslation($languageCode);
        return $translation ? $translation->step_text : $this->step_text;
    }

    // التحقق من وجود ترجمة للغة معينة
    public function hasTranslation($languageCode)
    {
        if ($languageCode === 'ar') {
            return true;
        }

        return $this->translations()->where('language_code', $languageCode)->exists();
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
