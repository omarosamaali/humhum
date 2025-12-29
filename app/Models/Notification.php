<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications'; // اسم الجدول

    protected $fillable = ['user_id', 'message', 'is_read', 'family_member_id', 'cook_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function familyMember()
    {
        return $this->belongsTo(MyFamily::class, 'family_member_id');
    }

    public function cook()
    {
        return $this->belongsTo(Cook::class, 'cook_id');
    }
}
