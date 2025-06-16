<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeautyArticle extends Model
{
    protected $fillable = [
        'title',
        'thumbnail_url',
        'article_url'
    ];
} 