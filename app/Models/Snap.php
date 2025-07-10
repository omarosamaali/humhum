<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Snap extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'video_path',
        'name',
        'status',
        'kitchen_id',
        'main_category_id',
        'recipe_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kitchen()
    {
        return $this->belongsTo(Kitchens::class);
    }

    public function subCategories()
    {
        return $this->belongsToMany(SubCategory::class, 'snap_sub_category', 'snap_id', 'sub_category_id');
    }
    public function mainCategory()
    {
        return $this->belongsTo(MainCategories::class, 'main_category_id');
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
