<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /**
     * Kolom yang boleh diisi secara mass-assignment.
     * Sesuai migration: create_locations_table
     */
    protected $fillable = [
        'name',
        'type',
        'lat',
        'lng',
        'description',
    ];
}
