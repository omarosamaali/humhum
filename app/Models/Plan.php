<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    // تحديد الأعمدة التي يمكن تعبئتها جماعيًا بأمان
    protected $fillable = [
        'package_id',
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
        'price',
        'duration_unit',
        'status',
    ];

    // تعريف العلاقة مع موديل الباقة (Package)
    // الخطة تنتمي إلى باقة واحدة
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    // Accessor: للحصول على النص الوصفي للحالة (فعال/غير فعال)
    public function getStatusTextAttribute()
    {
        return $this->status == 0 ? 'فعال' : 'غير فعال';
    }

    // Accessor: للحصول على كلاس CSS للون الشارة بناءً على الحالة
    public function getStatusBadgeClassAttribute()
    {
        return $this->status == 0 ? 'bg-success' : 'bg-danger';
    }

    // Accessor: للحصول على اسم الخطة باللغة الإنجليزية (يمكنك تكرارها للغات الأخرى إذا لزم الأمر)
    public function getNameEnAttribute($value)
    {
        return $value ?? $this->name_ar; // إذا لم يوجد اسم إنجليزي، استخدم الاسم العربي
    }

    // أضف Accessors للغات الأخرى هنا، مثلاً:
    public function getNameIdAttribute($value)
    {
        return $value ?? $this->name_ar; // إذا لم يوجد اسم إندونيسي، استخدم الاسم العربي
    }
    // كرر لبقية اللغات: name_am, name_hi, name_bn, name_ml, name_fil, name_ur, name_ta, name_ne, name_ps
    public function getNameAmAttribute($value)
    {
        return $value ?? $this->name_ar;
    }
    public function getNameHiAttribute($value)
    {
        return $value ?? $this->name_ar;
    }
    public function getNameBnAttribute($value)
    {
        return $value ?? $this->name_ar;
    }
    public function getNameMlAttribute($value)
    {
        return $value ?? $this->name_ar;
    }
    public function getNameFilAttribute($value)
    {
        return $value ?? $this->name_ar;
    }
    public function getNameUrAttribute($value)
    {
        return $value ?? $this->name_ar;
    }
    public function getNameTaAttribute($value)
    {
        return $value ?? $this->name_ar;
    }
    public function getNameNeAttribute($value)
    {
        return $value ?? $this->name_ar;
    }
    public function getNamePsAttribute($value)
    {
        return $value ?? $this->name_ar;
    }
}
