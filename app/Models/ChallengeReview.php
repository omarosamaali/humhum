<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChallengeReview extends Model
{
    protected $fillable = [
        'challenge_response_id',
        'chef_id',
        'rating',
        'chef_message_response',
        'sender_id',
    ];

    public function challengeResponse(): BelongsTo
    {
        return $this->belongsTo(ChallengeResponse::class);
    }

    public function chef(): BelongsTo
    {
        return $this->belongsTo(User::class, 'chef_id');
    }

    // إضافة العلاقة المفقودة
    public function messages(): HasMany
    {
        return $this->hasMany(ChallengeReviewMessage::class);
    }
}

