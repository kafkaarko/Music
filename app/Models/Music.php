<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;

    protected $fillable = [
        "name-music",
        "artist",
        "img",
        "genre",
        "description",
        "pendengar",
        "audio",
    ];
}
