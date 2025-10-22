<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blocked extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'family_member_id', 'recipe_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function familyMember()
    {
        return $this->belongsTo(MyFamily::class, 'family_member_id');
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
