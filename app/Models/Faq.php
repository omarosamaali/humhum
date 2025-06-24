<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'question_ar',
        'answer_ar',
        'question_en',
        'answer_en',
        'question_id',
        'answer_id',
        'question_am',
        'answer_am',
        'question_hi',
        'answer_hi',
        'question_bn',
        'answer_bn',
        'question_ml',
        'answer_ml',
        'question_fil',
        'answer_fil',
        'question_ur',
        'answer_ur',
        'question_ta',
        'answer_ta',
        'question_ne',
        'answer_ne',
        'question_ps',
        'answer_ps',
        'status',
        'order',
        'place',
    ];

    protected $casts = [
        'status' => 'boolean',
        'place' => 'string',
    ];

    public function scopeByPlace($query, $place)
    {
        return $query->where('place', $place);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function getStatusTextAttribute()
    {
        return $this->status ? 'فعال' : 'غير فعال';
    }

    public function getStatusBadgeClassAttribute()
    {
        return $this->status ? 'bg-success' : 'bg-danger';
    }
}
