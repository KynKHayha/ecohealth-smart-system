<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tip extends Model
{
    // TAMBAHKAN BARIS INI:
    protected $fillable = [
        'judul',
        'icon',
        'tag',
        'deskripsi'
    ];
}
class Tips extends Model
{
    protected $fillable = ['judul', 'icon', 'tag', 'deskripsi'];
}