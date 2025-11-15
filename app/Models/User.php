<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Stichoza\GoogleTranslate\GoogleTranslate;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'membership_number',
        'name_ar',
        'name_en',
        'name_id',
        'name_am',
        'name_hi',
        'country',
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
        'family_member_id',
        'system'
    ];


    protected static $translator = null;

    protected static function getTranslator()
    {
        if (self::$translator === null) {
            self::$translator = new GoogleTranslate();
            self::$translator->setSource('ar');
            self::$translator->setTarget('en');
        }
        return self::$translator;
    }
    public function getNameAttribute($value)
    {
        $locale = app()->getLocale();
        if ($locale == 'ar') {
            return $value;
        }
        try {
            $translator = self::getTranslator();
            return $translator->translate($value);
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function challenges()
    {
        return $this->hasMany(Challenge::class);
    }

    public function snaps()
    {
        return $this->hasMany(Snap::class);
    }

    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'otp_expires_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'contract_signed_at' => 'datetime',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
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

    public function favorites()
    {
        return $this->belongsToMany(Recipe::class, 'favorites')->withTimestamps();
    }

    public function setCountryAttribute($value)
    {
        $this->attributes['country'] = strtolower($value);
    }

    public function my_family(){
        return $this->hasMany(MyFamily::class);
    }

    public function cooks()
    {
        return $this->hasMany(Cook::class);
    }

    public function familyMember()
    {
        return $this->belongsTo(MyFamily::class, 'family_member_id');
    }
    
    public function tip(){
        return $this->hasMany(Tip::class);
    }

    public function familyMembers()
    {
        return $this->hasMany(MyFamily::class, 'user_id');
    }

    public function allNotifications()
    {
        // جلب IDs جميع أفراد العائلة
        $familyIds = $this->familyMembers()->pluck('id');

        // دمج ID المستخدم الرئيسي مع IDs أفراد العائلة
        $allIds = $familyIds->push($this->id);

        return Notification::whereIn('user_id', $allIds)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
