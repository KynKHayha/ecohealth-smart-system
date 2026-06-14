<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara mass-assignment (whitelist approach).
     * Hapus $guarded = [] karena kontradiksi dengan $fillable.
     */
    protected $fillable = [
        'nama_tanaman',
        'nama_latin',
        'image',
        'kategori',
        'rw',
        'manfaat',
        'cara_olah',
        'stok',
        'min_stok',
        'slug',
    ];
}