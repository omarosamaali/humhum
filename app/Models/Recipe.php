<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'dish_image', 
        'kitchen_type_id', 
        'chef_id', 
        'main_category_id', 
        'ingredients', 
        'steps', // إضافة steps للـ fillable
        'servings', 
        'preparation_time', 
        'calories', 
        'fats', 
        'carbs', 
        'protein', 
        'is_free', 
        'status'
    ];
    protected $casts = [
        // 'is_free' => 'boolean',
        // 'status' => 'boolean',
        'steps' => 'array', // هذا هو الأهم: لكي يتعامل Laravel مع 'steps' كمصفوفة JSON
    ];
    protected static function booted()
    {
        static::creating(function (Recipe $recipe) {
            do {
                $code = str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);
            } while (Recipe::where('recipe_code', $code)->exists());
            $recipe->recipe_code = $code;
        });
    }

    public function setIngredientsAttribute($value)
    {
        $this->attributes['ingredients'] = $value;
    }

    public function getIngredientsAttribute($value)
    {
        if (empty($value)) {
            return '';
        }
        return $value;
    }

    public function getParsedIngredientsAttribute()
    {
        if (empty($this->attributes['ingredients'])) {
            return [];
        }
        $parsedIngredients = [];
        $lines = explode("\n", $this->attributes['ingredients']);
        foreach ($lines as $line) {
            $trimmedLine = trim($line);
            if (empty($trimmedLine)) {
                continue;
            }
            if (str_starts_with($trimmedLine, '##')) {
                $parsedIngredients[] = [
                    'type' => 'heading',
                    'value' => ltrim($trimmedLine, '## ')
                ];
            } else {
                $parsedIngredients[] = [
                    'type' => 'ingredient',
                    'value' => $trimmedLine
                ];
            }
        }
        return $parsedIngredients;
    }

    // Relationships
    public function subCategories()
    {
        return $this->belongsToMany(SubCategory::class, 'recipe_sub_category', 'recipe_id', 'sub_category_id');
    }

    public function Kitchens()
    {
        return $this->belongsTo(Kitchens::class);
    }

    public function chef()
    {
        return $this->belongsTo(User::class, 'chef_id');
    }

    public function mainCategories()
    {
        return $this->belongsTo(MainCategories::class, 'main_category_id');
    }

    /**
     * Get the steps for the recipe from recipe_steps table.
     */
    public function recipeSteps()
    {
        return $this->hasMany(RecipeStep::class, 'recipe_id')->orderBy('id', 'asc');
    }

    /**
     * Legacy method - keep for backward compatibility
     * Use recipeSteps() for the relationship
     */
    public function steps()
    {
        return $this->hasMany(RecipeStep::class, 'recipe_id')->orderBy('id', 'asc');
    }
}