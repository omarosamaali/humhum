<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'flag_image',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean', // يضمن أن `status` يتم التعامل معه كـ boolean
    ];

    // Accessor لعرض حالة اللغة كنص
    public function getStatusTextAttribute()
    {
        return $this->status ? 'فعال' : 'غير فعال';
    }

    // Accessor للحصول على كلاس الشارة بناءً على الحالة
    public function getStatusBadgeClassAttribute()
    {
        return $this->status ? 'bg-success' : 'bg-danger';
    }

    // Accessor للحصول على مسار URL لصورة العلم
    public function getFlagImageUrlAttribute()
    {
        // إذا كان هناك flag_image مخزن، استخدمه، وإلا استخدم صورة علم افتراضية.
        // تأكد أن المسار asset('images/default_flag.png') صحيح.
        return $this->flag_image ? Storage::url($this->flag_image) : asset('assets/img/logo.svg');
    }
}
