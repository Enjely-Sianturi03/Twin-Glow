<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'testimoni',
        'is_approved'
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];
}
