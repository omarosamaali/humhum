<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChallengeReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'challenge_response_id',
        'chef_id',
        'rating',
        'chef_message_response',
    ];

    public function challengeResponse()
    {
        return $this->belongsTo(ChallengeResponse::class);
    }

    public function chef()
    {
        return $this->belongsTo(User::class, 'chef_id');
    }
}
