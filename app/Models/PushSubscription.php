<?php

// app/Models/PushSubscription.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use NotificationChannels\WebPush\PushSubscription as WebPushSubscription;

class PushSubscription extends WebPushSubscription // (مهم: الوراثة من الكلاس الصحيح)
{
    protected $fillable = [
        'user_id',
        'endpoint',
        'public_key',
        'auth_token',
        'content_encoding',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}