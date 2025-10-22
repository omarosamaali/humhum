<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Tip extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_id',
        'name_am',
        'name_hi',
        'name_bn',
        'name_ml',
        'name_fil',
        'name_ur',
        'name_ta',
        'name_en',
        'name_ne',
        'name_ps',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
