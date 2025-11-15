<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{
    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'family_members',
        'meals'
    ];

    protected $casts = [
        'family_members' => 'array',
        'meals' => 'array',
    ];

    public function details()
    {
        return $this->hasMany(MealPlanDetail::class, 'meal_plan_id');
    }
}
