<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tip extends Model
{
    protected $fillable = [
        'judul',
        'icon',
        'image',
        'tag',
        'deskripsi',
    ];
}