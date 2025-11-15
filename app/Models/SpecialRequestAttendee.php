<?php

// app/Models/SpecialRequestAttendee.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialRequestAttendee extends Model
{
    protected $fillable = ['special_request_id', 'attendee_id', 'attendee_type'];

    public function specialRequest()
    {
        return $this->belongsTo(SpecialRequest::class);
    }
}