<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChallengeResponse extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'challenge_id',      // ID التحدي الذي تم الرد عليه
        'user_id',           // ID المستخدم الذي قام بالرد
        'recipe_image_path', // مسار صورة الوصفة التي أرسلها المستخدم
        'challenge_video_path', // مسار فيديو الاستجابة الذي أرسله المستخدم
        'message_to_chef',   // رسالة المستخدم إلى الشيف (صاحب التحدي)
        'status',            // حالة الاستجابة (مثل 'pending', 'accepted', 'rejected')
    ];

    /**
     * Get the challenge that owns the response.
     */
    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }

    /**
     * Get the user (who submitted the response) that owns the response.
     */
    public function user()
    {
        return $this->belongsTo(User::class); // افترض أن Users هو موديل المستخدمين
    }
}
