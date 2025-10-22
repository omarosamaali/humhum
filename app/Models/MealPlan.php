<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{
    use HasFactory;

    protected $fillable = ['start_date', 'end_date', 'family_members', 'user_id'];

    protected $casts = [
        'family_members' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function details()
    {
        return $this->hasMany(MealPlanDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
