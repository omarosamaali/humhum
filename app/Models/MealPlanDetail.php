<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealPlanDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'meal_plan_id',
        'meal_date',
        'meal_type',
        'recipe_id',
        'meal_time',
        'additions',
        'notes',
        'is_active'
    ];

    protected $casts = [
        'additions' => 'array',
        'meal_date' => 'date',
        'meal_time' => 'datetime:H:i',
    ];

    public function mealPlan()
    {
        return $this->belongsTo(MealPlan::class);
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
