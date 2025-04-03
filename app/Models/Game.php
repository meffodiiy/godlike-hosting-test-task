<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'title',
        'developer',
        'genre',
        'release_date',
        'platform',
        'price'
    ];

    protected $casts = [
        'release_date' => 'date',
        'price' => 'decimal:2'
    ];
}
