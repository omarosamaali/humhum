<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Translation;
use App\Models\MainCategories;
use App\Models\Kitchens;
use App\Models\User;
use App\Models\SubCategory;
use App\Models\RecipeStep;
use Stichoza\GoogleTranslate\GoogleTranslate;

class Recipe extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected static $translator = null;

    protected static function getTranslator()
    {
        if (self::$translator === null) {
            self::$translator = new GoogleTranslate();
            self::$translator->setSource('ar');
            self::$translator->setTarget('en');
        }
        return self::$translator;
    }

    public function getTitleAttribute($value)
    {
        $locale = app()->getLocale();
        if ($locale == 'ar') {
            return $value;
        }
        try {
            $translator = self::getTranslator();
            return $translator->translate($value);
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function getIngredientsAttribute($value)
    {
        $locale = app()->getLocale();
        if ($locale == 'ar') {
            return $value;
        }
        try {
            $translator = self::getTranslator();
            return $translator->translate($value);
        } catch (\Exception $e) {
            return $value;
        }
    }
    public function getStepsAttribute($value)
    {
        $steps = is_string($value) ? json_decode($value, true) : $value;
        $locale = app()->getLocale();

        // لو اللغة العربية، نرجع النص كما هو
        if ($locale == 'ar' || empty($steps)) {
            return $steps;
        }

        try {
            $translator = self::getTranslator();

            // نترجم كل وصف داخل الخطوات
            foreach ($steps as &$step) {
                if (isset($step['description']) && !empty($step['description'])) {
                    $step['description'] = $translator->translate($step['description']);
                }
            }
        } catch (\Exception $e) {
            // لو حصل خطأ في الترجمة نرجع النص الأصلي
            return $steps;
        }

        return $steps;
    }
    protected $fillable = [
        'title',
        'dish_image',
        'kitchen_type_id',
        'chef_id',
        'main_category_id',
        'ingredients',
        'steps',
        'servings',
        'preparation_time',
        'calories',
        'fats',
        'carbs',
        'protein',
        'is_free',
        'status',
        'price',
        'user_id',
        'views'
    ];

    protected $casts = [
        'steps' => 'array',
    ];

    public function translations()
    {
        return $this->morphMany(Translation::class, 'translatable');
    }

    public function getTranslation($languageCode)
    {
        return $this->translations()->where('language_code', $languageCode)->first();
    }

    public function getTranslatedTitle($languageCode = null)
    {
        if (!$languageCode) {
            $languageCode = app()->getLocale();
        }

        if ($languageCode === 'ar') {
            return $this->title;
        }

        $translation = $this->getTranslation($languageCode);
        return $translation ? $translation->title : $this->title;
    }

    public function getTranslatedDescription($languageCode = null)
    {
        if (!$languageCode) {
            $languageCode = app()->getLocale();
        }

        if ($languageCode === 'ar') {
            return $this->description ?? '';
        }

        $translation = $this->getTranslation($languageCode);
        return $translation ? $translation->description : ($this->description ?? '');
    }

    public function getTranslatedIngredients($languageCode = null)
    {
        if (!$languageCode) {
            $languageCode = app()->getLocale();
        }

        if ($languageCode === 'ar') {
            return $this->ingredients;
        }

        $translation = $this->getTranslation($languageCode);
        return $translation ? $translation->ingredients : $this->ingredients;
    }

    public function getTranslatedInstructions($languageCode = null)
    {
        if (!$languageCode) {
            $languageCode = app()->getLocale();
        }

        if ($languageCode === 'ar') {
            return $this->instructions ?? '';
        }

        $translation = $this->getTranslation($languageCode);
        return $translation ? $translation->instructions : ($this->instructions ?? '');
    }

    protected static function booted()
    {
        static::creating(function (Recipe $recipe) {
            do {
                $code = str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);
            } while (Recipe::where('recipe_code', $code)->exists());
            $recipe->recipe_code = $code;
        });
    }

    public function subCategories()
    {
        return $this->belongsToMany(SubCategory::class, 'recipe_sub_category', 'recipe_id', 'sub_category_id');
    }

    public function kitchen()
    {
        return $this->belongsTo(Kitchens::class, 'kitchen_type_id');
    }

    public function chef()
    {
        return $this->belongsTo(User::class, 'chef_id');
    }

    public function mainCategories()
    {
        return $this->belongsTo(MainCategories::class, 'main_category_id', 'id');
        
    }

    public function recipeSteps()
    {
        return $this->hasMany(RecipeStep::class, 'recipe_id')->orderBy('id', 'asc');
    }

    // دالة للتحقق من وجود ترجمة للغة معينة
    public function hasTranslation($languageCode)
    {
        if ($languageCode === 'ar') {
            return true; // العربية هي اللغة الأساسية
        }

        return $this->translations()->where('language_code', $languageCode)->exists();
    }

    // دالة للحصول على نسبة اكتمال الترجمة
    public function getTranslationCompleteness($languageCode)
    {
        if ($languageCode === 'ar') {
            return 100;
        }

        $translation = $this->getTranslation($languageCode);
        if (!$translation) {
            return 0;
        }

        $fields = ['title', 'description', 'ingredients', 'instructions'];
        $completedFields = 0;

        foreach ($fields as $field) {
            if (!empty($translation->{$field})) {
                $completedFields++;
            }
        }

        return round(($completedFields / count($fields)) * 100);
    }

    // دالة للحصول على حالة الترجمة
    public function getTranslationStatus($languageCode)
    {
        if ($languageCode === 'ar') {
            return 'original';
        }

        $completeness = $this->getTranslationCompleteness($languageCode);

        if ($completeness === 0) {
            return 'missing';
        } elseif ($completeness === 100) {
            return 'complete';
        } else {
            return 'partial';
        }
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'recipe_id');
    }
    public function mainCategory()
    {
        return $this->belongsTo(MainCategories::class, 'main_category_id');
    }

    public function blockeds()
    {
        return $this->hasMany(Blocked::class, 'recipe_id');
    }
}
