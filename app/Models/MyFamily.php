<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyFamily extends Model
{
    protected $table = 'my_family';

    protected $fillable = [
        'avatar',
        'name',
        'language',
        'send_notification',
        'has_email',
        'owner',
        'family_number',
        'password',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tips()
    {
        return $this->belongsToMany(Tip::class, 'my_family_tip')
            ->withTimestamps();
    }
    // في App\Models\MyFamily
    public function tip()
    {
        return $this->hasMany(MyFamilyTip::class, 'my_family_id');
    }
    public function customTips()
    {
        return $this->hasMany(MyFamilyTip::class)
            ->whereNotNull('custom_tip');
    }

    public function allTips()
    {
        return $this->hasMany(MyFamilyTip::class);
    }

    public function familyMember()
    {
        return $this->belongsTo(MyFamily::class, 'family_member_id', 'id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id', 'id');
    }

    public function spceialRequests()
    {
        return $this->hasMany(SpecialRequest::class);
    }
}
