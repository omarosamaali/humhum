<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'report_type',
        'chef_profile_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship to the user who made the report
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship to the chef profile
    public function chefProfile()
    {
        return $this->belongsTo(ChefProfile::class, 'chef_profile_id', 'id');
    }

    // Get chef name
    public function getChefName()
    {
        return $this->chefProfile ? $this->chefProfile->user->name : 'غير محدد';
    }
}
