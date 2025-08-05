<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ChefProfile;
use App\Models\Recipe; // Don't forget to import the Recipe model!

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
        'recipe_id', // Changed from 'recipe' to 'recipe_id'
        'price',
        'challenge_type',
        'status',
        'user_id',
        'chef_id',
    ];

    /**
     * Get the chef associated with the challenge.
     */
    public function chef()
    {
        // Assuming 'chef_id' in challenges table points to 'id' in users table
        return $this->belongsTo(User::class, 'chef_id');
    }
    public function challengeResponses()
    {
        // A Challenge has many ChallengeResponses
        // The foreign key (challenge_id) is expected in the challenge_responses table
        return $this->hasMany(ChallengeResponse::class, 'challenge_id');
    }
    public function responses()
    {
        // افترض أن اسم موديل الاستجابات هو ChallengeResponse
        // وأن الـ foreign key في جدول الـ responses هو challenge_id
        return $this->hasMany(ChallengeResponse::class, 'challenge_id');
    }

    /**
     * Get the chef profile associated with the challenge.
     * Note: This relationship seems a bit unusual (user_id to user_id on ChefProfile).
     * If 'user_id' in challenges refers to the challenge creator (a user),
     * and ChefProfile's 'user_id' is its foreign key to the User model,
     * then this might be correct. Otherwise, you might need to adjust.
     */
    public function chefProfile()
    {
        return $this->belongsTo(ChefProfile::class, 'user_id', 'user_id');
    }

    /**
     * Get the user who created the challenge.
     * Assuming 'user_id' in challenges table points to 'id' in users table.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the recipe that the challenge is associated with.
     */
    public function recipe()
    {
        return $this->belongsTo(Recipe::class); // Assumes recipe_id in challenges table
        // points to 'id' in recipes table
    }
}
