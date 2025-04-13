<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $fillable = [
        'username',
        'password',
        'seat_one',
        'seat_two',
        'seat_three',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];
} 