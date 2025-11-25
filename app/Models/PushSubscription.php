<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PushSubscription extends Model
{
    protected $fillable = [
        'user_id',
        'family_id',
        'cook_id',
        'player_id',
        'device_type'
    ];
}
