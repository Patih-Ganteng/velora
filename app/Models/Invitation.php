<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = [
        'user_id', 'category', 'sub_theme', 'title', 'event_date', 'config', 'status'
    ];
        protected $casts = [
        'config' => 'array',
    ];

    // Relasi: Undangan milik satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // TAMBAHKAN RELASI INI 👇
    public function guests()
    {
        return $this->hasMany(Guest::class);
    }

        public function messages()
    {
        return $this->hasMany(Message::class)->latest(); // Urutkan dari yang terbaru
    }
}