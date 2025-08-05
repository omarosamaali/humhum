<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Types extends Model
{
    protected $table = 'types';

    protected $fillable = [
        'title_ar',
        'title_id',
        'title_am',
        'title_hi',
        'title_bn',
        'title_ml',
        'title_fil',
        'title_ur',
        'title_ta',
        'title_en',
        'title_ne',
        'title_ps',
        'description_ar',
        'description_id',
        'description_am',
        'description_hi',
        'description_bn',
        'description_ml',
        'description_fil',
        'description_ur',
        'description_ta',
        'description_en',
        'description_ne',
        'description_ps',
        'main_image',
        'sub_image',
        'status',
    ];

    public function getMainImageUrlAttribute()
    {
        return $this->main_image ? Storage::url($this->main_image) : null;
    }

    public function getSubImageUrlAttribute()
    {
        return $this->sub_image ? Storage::url($this->sub_image) : null;
    }

    public function getStatusBadgeClassAttribute()
    {
        return $this->status ? 'bg-success' : 'bg-danger';
    }

    public function getStatusTextAttribute()
    {
        return $this->status ? 'فعال' : 'غير فعال';
    }
}
