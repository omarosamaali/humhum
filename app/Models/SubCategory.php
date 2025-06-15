<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    // تحديد اسم الجدول إذا كان مختلفًا عن اسم الموديل بصيغة الجمع
    protected $table = 'sub_categories';

    // الأعمدة التي يمكن تعبئتها جماعيًا (Mass Assignment)
    protected $fillable = [
        'category_id',
        'name_ar',
        'name_en',
        'name_id',
        'name_am',
        'name_hi',
        'name_bn',
        'name_ml',
        'name_fil',
        'name_ur',
        'name_ta',
        'name_ne',
        'name_ps',
        'status',
    ];

    // تحديد نوع البيانات لبعض الأعمدة
    protected $casts = [
        'status' => 'boolean',
    ];

    // علاقة "ينتمي إلى" (Belongs To) مع MainCategory
    public function mainCategory() // Changed from MainCategories() to mainCategory()
    {
        return $this->belongsTo(MainCategories::class, 'category_id'); // Changed MainCategories::class to MainCategory::class
    }

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'recipe_sub_category', 'sub_category_id', 'recipe_id');
    }
}
