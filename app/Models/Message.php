<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Message extends Model
{
    protected $fillable = ['user_id', 'title', 'content', 'file_path', 'status', 'type'];

    // علاقة Polymorphic مع MessageReply
    public function replies()
    {
        return $this->morphMany(MessageReply::class, 'messageable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}