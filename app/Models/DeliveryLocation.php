<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryLocation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'country', 'city', 'area', 'delivery_fee', 'is_selected', 'has_market'];

    protected $casts = [
        'is_selected' => 'boolean',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
