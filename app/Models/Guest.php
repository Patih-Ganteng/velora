<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'invitation_id', 'name', 'phone', 'rsvp_status', 'unique_code'
    ];

    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }
}