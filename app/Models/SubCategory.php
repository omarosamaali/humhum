<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_id',
        'name_am',
        'name_hi',
        'name_bn',
        'name_ml',
        'name_fil',
        'name_ur',
        'name_ta',
        'name_en',
        'name_ne',
        'name_ps',
        'category_id', // التأكد من اسم العمود الصحيح
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    // العلاقة مع التصنيف الرئيسي
    public function mainCategory()
    {
        return $this->belongsTo(MainCategories::class, 'category_id');
    }

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'recipe_sub_category', 'sub_category_id', 'recipe_id');
    }

    public function Translations()
    {
        return $this->morphMany(Translation::class, 'translatable');
    }
}
