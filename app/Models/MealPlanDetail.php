<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealPlanDetail extends Model
{
    protected $fillable = [
        'meal_plan_id',
        'meal_date',
        'meal_type',
        'recipe_id',
        'is_active',
        'user_id',
        'salad_id',
        'drink_id',
        'appetizers_id',
        'healthy_food_id',
        'soup_id',
        'desserts_id',
        'sauces_id',
        'side_dish_id',
    ];

    public function mealPlan()
    {
        return $this->belongsTo(MealPlan::class);
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function salad()
    {
        return $this->belongsTo(Recipe::class, 'salad_id');
    }

    public function drink()
    {
        return $this->belongsTo(Recipe::class, 'drink_id');
    }

    public function appetizer()
    {
        return $this->belongsTo(Recipe::class, 'appetizers_id');
    }

    public function healthyFood()
    {
        return $this->belongsTo(Recipe::class, 'healthy_food_id');
    }

    public function soup()
    {
        return $this->belongsTo(Recipe::class, 'soup_id');
    }

    public function dessert()
    {
        return $this->belongsTo(Recipe::class, 'desserts_id');
    }

    public function sauce()
    {
        return $this->belongsTo(Recipe::class, 'sauces_id');
    }

    public function sideDish()
    {
        return $this->belongsTo(Recipe::class, 'side_dish_id');
    }

    public function favorited_by_count()
    {
        return $this->hasMany(Favorite::class, 'recipe_id');
    }
}
