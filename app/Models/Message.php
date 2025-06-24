<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['title', 'content', 'file_path', 'status', 'response'];
}
