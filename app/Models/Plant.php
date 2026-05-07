<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    use HasFactory;

    // Tambahkan baris ini agar semua kolom bisa diisi secara otomatis
    protected $guarded = []; 
    protected $fillable = [
    'nama_tanaman', 
    'nama_latin', 
    'image', 
    'kategori', 
    'rw', // <--- Tambahkan ini
    'manfaat', 
    'cara_olah', 
    'stok', 
    'min_stok', 
    'slug'
];
}