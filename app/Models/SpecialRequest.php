<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',             // القديم (اختياري الآن)
        'family_user_id',      // العمود الجديد
        'cook_id',
        'family_member_id',
        'recipe_id',
        'meal_type',
        'guests_count',
        'date',
        'time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cook()
    {
        return $this->belongsTo(Cook::class, 'cook_id');
    }

    public function familyMember()
    {
        return $this->belongsTo(MyFamily::class, 'family_member_id');
    }

    public function familyUser()
    {
        return $this->belongsTo(User::class, 'family_user_id');
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function attendees()
    {
        return $this->hasMany(SpecialRequestAttendee::class);
    }

    // Helper method للحصول على الطباخ (سواء طباخ محترف أو فرد عائلة)
    public function getCookerAttribute()
    {
        return $this->cook ?? $this->familyMember;
    }

    // Helper method للحصول على اسم الطباخ
    public function getCookerNameAttribute()
    {
        if ($this->cook) {
            return $this->cook->name;
        }

        if ($this->familyMember) {
            return $this->familyMember->name;
        }

        return 'غير محدد';
    }

    // Helper method لمعرفة نوع الطباخ
    public function getCookerTypeAttribute()
    {
        if ($this->cook_id) {
            return 'cook';
        }

        if ($this->family_member_id) {
            return 'family';
        }

        return null;
    }

    public function familyUserRecipe()
    {
        return $this->belongsTo(MyFamily::class, 'family_user_id');
    }
}
