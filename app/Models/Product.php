<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'base_price',          // تم الإضافة
        'payment_gateway_fee', // تم الإضافة
        'selling_price',       // تم الإضافة
        'type',
        'description',
        'image_path',
        'digital_file_path',
        'is_active',
    ];
}
