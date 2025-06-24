<?php
// 1. إصلاح model MainCategories
// في app/Models/MainCategories.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MainCategories extends Model
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
        'image',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    // Accessor للحصول على مسار الصورة الكامل
    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::url($this->image) : null;
    }

    public function getStatusTextAttribute()
    {
        return $this->status ? 'فعال' : 'غير فعال';
    }

    public function getStatusBadgeClassAttribute()
    {
        return $this->status ? 'bg-success' : 'bg-danger';
    }

    // العلاقة الصحيحة مع التصنيفات الفرعية
    public function subCategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id'); // تأكد من اسم العمود الصحيح
    }

    public function recipes()
    {
        return $this->hasMany(Recipe::class, 'main_category_id', 'id');
    }

    public function Translations()
    {
        return $this->morphMany(Translation::class, 'translatable');
    }
}
