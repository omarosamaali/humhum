<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MessageReply extends Model
{
    protected $fillable = ['user_id', 'content', 'file_path', 'status'];

    // علاقة Polymorphic
    public function messageable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}