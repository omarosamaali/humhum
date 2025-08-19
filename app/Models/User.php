<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'name',
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
        'email',
        'password',
        'phone_number',
        'phone_verified_at',
        'profile_image',
        'user_type',
        'status',
        'role',
        'otp',
        'otp_expires_at',
        'contract_signed_at',
        'avatar',
        'system'
    ];

    public function challenges()
    {
        return $this->hasMany(Challenge::class);
    }

    public function snaps()
    {
        return $this->hasMany(Snap::class);
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'otp_expires_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'contract_signed_at' => 'datetime',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin()
    {
        return $this->role === 'مدير';
    }

    public function isSupervisor()
    {
        return $this->role === 'مشرف';
    }

    public function isDataEntry()
    {
        return $this->role === 'مدخل بيانات';
    }

    public function isActive()
    {
        return $this->status === 'فعال';
    }

    public function isChef()
    {
        return $this->role === 'طاه';
    }

    public function getRoleBadgeClass()
    {
        return match ($this->role) {
            'مدير' => 'bg-primary',
            'مشرف' => 'bg-success',
            'مدخل بيانات' => 'bg-warning text-dark',
            'طاه' => 'bg-info',
            default => 'bg-secondary'
        };
    }
    public function getStatusTextAttribute()
    {
        return match ($this->status) {
            'فعال' => 'فعال',
            'غير فعال' => 'غير فعال',
            'بانتظار التفعيل' => 'بانتظار التفعيل',
            default => 'غير معروف'
        };
    }
    public function getStatusBadgeClass()
    {
        return match ($this->status) {
            'فعال' => 'badge-success',
            'غير فعال' => 'badge-danger',
            'بانتظار التفعيل' => 'badge-warning',
            default => 'badge-secondary'
        };
    }

    public function challengeReviews()
    {
        return $this->hasMany(ChallengeReview::class, 'chef_id');
    }
    public function recipes()
    {
        return $this->hasMany(Recipe::class, 'chef_id', 'id');
    }

    public function chefProfile()
    {
        return $this->hasOne(ChefProfile::class);
    }

    public function deliveryLocations()
    {
        return $this->hasMany(DeliveryLocation::class);
    }

    public function socialMedia()
    {
        return $this->hasOne(SocialMedia::class);
    }
}
