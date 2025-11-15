<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = [
        'user_id',
        'recipe_id',
    ];

    public function details()
    {
        return $this->hasMany(MealPlanDetail::class, 'meal_plan_id');
    }
}
