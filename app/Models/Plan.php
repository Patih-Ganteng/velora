<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = ['name', 'slug', 'price', 'features', 'is_active'];

    // PASTIKAN INI ADA 👇
    protected $casts = [
        'features' => 'array',
    ];
}