<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cook extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'image',
        'language',
        'password',
        'cook_number',
        'cook_id',
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }
}
