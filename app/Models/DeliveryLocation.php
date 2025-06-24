<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'country',
        'city',
        'area',
        'delivery_fee',
        'has_market',
    ];

    protected $casts = [
        'delivery_fee' => 'decimal:2',
        'has_market' => 'boolean',
    ];

    /**
     * Get the user that owns the delivery location.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope to get only real delivery locations (not placeholder records)
     */
    public function scopeRealLocations($query)
    {
        return $query->where('country', '!=', 'غير محدد');
    }

    /**
     * Scope to get placeholder records
     */
    public function scopePlaceholders($query)
    {
        return $query->where('country', 'غير محدد');
    }
}