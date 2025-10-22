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

    public function customTips()
    {
        return $this->hasMany(MyFamilyTip::class)
            ->whereNotNull('custom_tip');
    }

    // جلب كل الإرشادات (الجاهزة + المخصصة)
    public function allTips()
    {
        return $this->hasMany(MyFamilyTip::class);
    }
}
