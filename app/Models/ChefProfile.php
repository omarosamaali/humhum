<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChefProfile extends Model
{
    protected $fillable = [
        'user_id',
        'country',
        'bio',
        'contract_type',
        'profit_transfer_details',
        'official_image',
        'subscription_3_months_price',   // جديد
        'subscription_6_months_price',   // جديد
        'subscription_12_months_price',  // جديد
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
