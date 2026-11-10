<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['invitation_id', 'name', 'message'];

    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }
}