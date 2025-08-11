<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChallengeReviewMessage extends Model
{
    protected $fillable = [
        'challenge_review_id',
        'sender_id',
        'message',
        'is_read'
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function challengeReview(): BelongsTo
    {
        return $this->belongsTo(ChallengeReview::class);
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
