<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyFamilyTip extends Model
{
    protected $table = 'my_family_tip';

    protected $fillable = [
        'my_family_id',
        'tip_id',
        'custom_tip'
    ];

    public function myFamily()
    {
        return $this->belongsTo(MyFamily::class);
    }

    public function tip()
    {
        return $this->belongsTo(Tip::class);
    }

    public function tips()
    {
        return $this->belongsTo(MyFamilyTip::class);
    }

    public function familyMember()
    {
        return $this->belongsTo(MyFamily::class, 'my_family_id');
    }
}
