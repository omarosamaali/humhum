<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_id',
        'name_am', // جديد
        'name_hi', // جديد
        'name_bn', // جديد
        'name_ml', // جديد
        'name_fil', // جديد
        'name_ur', // جديد
        'name_ta', // جديد
        'name_en', // جديد
        'name_ne', // جديد
        'name_ps', // جديد
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

    // Accessor للحصول على كلاس Bootstrap للـ badge حسب الحالة
    public function getStatusBadgeClassAttribute()
    {
        return $this->status ? 'bg-success' : 'bg-danger';
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
