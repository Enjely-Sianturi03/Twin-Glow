<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationalHours extends Model
{
    use HasFactory;

    protected $fillable = [
        'day',
        'open_time',
        'close_time',
        'is_open'
    ];

    protected $casts = [
        'is_open' => 'boolean',
        'open_time' => 'datetime',
        'close_time' => 'datetime'
    ];
} 