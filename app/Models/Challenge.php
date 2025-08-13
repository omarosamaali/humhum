<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ChefProfile;
use App\Models\Recipe;

class Challenge extends Model
{
    use HasFactory;

    protected $fillable = [
        'announcement_path',
        'message',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'recipe_id',
        'price',
        'challenge_type',
        'status',
        'user_id',
        'chef_id',
        'prize_type',        // New field
        'prize_name',
        'prize_image',
    ];

    /**
     * Get the chef associated with the challenge.
     */

    protected $casts = [
        'viewed_by' => 'array',
        'liked_by' => 'array', // أضف هذا السطر
        'bookmarked_by' => 'array',

    ];

    public function chef()
    {
        return $this->belongsTo(User::class, 'chef_id');
    }

    public function reviews()
    {
        return $this->hasManyThrough(
            ChallengeReview::class,
            ChallengeResponse::class,
            'challenge_id',
            'challenge_response_id',
            'id',
            'id'
        );
    }

    public function challengeResponses()
    {
        return $this->hasMany(ChallengeResponse::class, 'challenge_id');
    }

    public function responses()
    {
        return $this->hasMany(ChallengeResponse::class, 'challenge_id');
    }

    public function chefProfile()
    {
        return $this->belongsTo(ChefProfile::class, 'user_id', 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    /**
     * Check if the challenge has a prize
     */
    public function hasPrize()
    {
        return $this->prize_type !== 'none';
    }

    /**
     * Get the prize type description in Arabic
     */
    public function getPrizeTypeDescriptionAttribute()
    {
        switch ($this->prize_type) {
            case 'highest_rating':
                return 'لأعلى تقييم';
            case 'top_three':
                return 'لأعلى ثلاث تقييمات';
            case 'all_participants':
                return 'لجميع المشاركين';
            case 'none':
            default:
                return 'لا توجد جائزة';
        }
    }
}
