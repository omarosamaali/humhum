<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            // إزالة casts لـ status لأنه enum نصي
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
    
    public function recipes()
    {
        return $this->hasMany(Recipe::class, 'chef_id');
    }

    public function chefProfile()
    {
        return $this->hasOne(ChefProfile::class);
    }
}
