<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Message extends Model
{
    protected $fillable = ['title','user_id' ,'content', 'file_path', 'status', 'response'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(MessageReply::class);
    }
}
