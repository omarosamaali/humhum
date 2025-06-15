<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeStep extends Model
{
    use HasFactory;

    protected $table = 'recipe_steps';

    protected $fillable = [
        'recipe_id',
        'step_text',
        'media' // هذا صحيح
    ];

    protected $casts = [
        'media' => 'array', // هذا صحيح
    ];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class, 'recipe_id');
    }
}
