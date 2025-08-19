<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;

    protected $table = 'social_media';

    protected $fillable = [
        'youtube',
        'tiktok',
        'instagram',
        'snapchat',
        'facebook',
        'is_active',
        'user_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all active social media links
     */
    public static function getActiveLinks()
    {
        return self::where('is_active', true)->first();
    }

    /**
     * Get formatted social media links array
     */
    public function getLinksArray()
    {
        return [
            'youtube' => $this->youtube,
            'tiktok' => $this->tiktok,
            
            'instagram' => $this->instagram,
            'snapchat' => $this->snapchat,
            'facebook' => $this->facebook,
        ];
    }

    /**
     * Check if any social media link exists
     */
    public function hasAnyLink()
    {
        return !empty($this->youtube) ||
            !empty($this->tiktok) ||
            !empty($this->instagram) ||
            !empty($this->snapchat) ||
            !empty($this->facebook);
    }
}
