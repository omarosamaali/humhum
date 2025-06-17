<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChefProfile extends Model
{
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
        'subscription_3_months_price',   // جديد
        'subscription_6_months_price',   // جديد
        'subscription_12_months_price',  // جديد
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
