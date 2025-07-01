<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'message_id',
        'user_id',
        'content',
        'file_path',
        'status',
    ];

    // علاقة الرد بالمستخدم الذي أرسله
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // علاقة الرد بالرسالة الأصلية التي ينتمي إليها
    public function message()
    {
        return $this->belongsTo(Message::class);
    }
}
