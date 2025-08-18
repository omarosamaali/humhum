<?php

namespace App\Models;

use App\Models\Snap; // تأكد من إضافة هذا السطر

use Illuminate\Database\Eloquent\Model;

class ChefProfile extends Model
{

    // تعريف الثابتات للحالات (كما فعلنا سابقًا)
    const STATUS_PENDING_COMPLETION = 'بإنتظار إستكمال البيانات';
    const STATUS_PENDING_ACTIVATION = 'قيد التفعيل'; // الحالة التي نريد أن يصل إليها الشيف بعد إكمال البيانات
    const STATUS_ACTIVE = 'فعال'; // أو 'معتمد'
    const STATUS_REJECTED = 'مرفوض';

    protected $fillable = [
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
        'name_ps',
        'name', // احتفظ بهذا إذا كنت لا تزيله أو تغير اسمه
        'user_id',
        'country',
        'bio',
        'contract_type',
        'profit_transfer_details',
        'official_image',
        'subscription_3_months_price',
        'subscription_6_months_price',
        'subscription_12_months_price',
    ];
    // public function snaps()
    // {
    //     return $this->hasMany(Snap::class);
    // }
    public function getIsDataCompleteAttribute(): bool
    {
        // تحقق من وجود العلاقة User
        if (!$this->user) {
            return false;
        }

        $isOfficialImageComplete = !empty($this->official_image);
        $isContractTypeComplete = !empty($this->contract_type);
        $isBioComplete = !empty($this->bio);
        $isContractSigned = !empty($this->user->contract_signed_at); // هذا من موديل User

        return $isOfficialImageComplete && $isContractTypeComplete && $isBioComplete && $isContractSigned;
    }

    public function snaps()
    {
        // الحل هنا: حدد الـ foreign key بشكل صريح
        // $this->hasMany(Snap::class, 'foreign_key', 'local_key');
        // العلاقة بين ChefProfile و Snaps هتكون من خلال user_id
        // لأن الـ ChefProfile مربوط بالـ User عن طريق user_id
        return $this->hasManyThrough(
            Snap::class,
            User::class,
            'id', // Foreign key on the users table...
            'user_id', // Foreign key on the snaps table...
            'user_id', // Local key on the chef_profiles table...
            'id' // Local key on the users table...
        );
    }
    public function challenges()
    {
        return $this->hasMany(Challenge::class, 'user_id', 'user_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'chef_profile_user', 'chef_profile_id', 'user_id')->withTimestamps();
    }

    public function isFollowedBy($user)
    {
        return $this->followers()->where('user_id', $user->id)->exists();
    }
}
