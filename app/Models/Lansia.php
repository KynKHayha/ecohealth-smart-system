<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lansia extends Model
{
    // Tambahkan baris ini biar Laravel izinin simpan data otomatis
    protected $fillable = ['nama', 'nik', 'alamat', 'penyakit', 'rw'];
}