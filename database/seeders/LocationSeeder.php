<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() 
{
    $locations = [
        [
            'name' => 'Pusat Greenhouse EcoHealth',
            'type' => 'greenhouse',
            'lat' => -6.617258, 
            'lng' => 106.779340,
            'description' => 'Pusat pembibitan dan penelitian tanaman herbal utama Desa Mekarjaya.'
        ],
        [
            'name' => 'Titik Pengelolaan Sampah',
            'type' => 'waste',
            'lat' => -6.616665, 
            'lng' => 106.777992,
            'description' => 'Area pemilahan sampah organik dan anorganik untuk pembuatan kompos.'
        ],
        [
            'name' => 'Vertical Garden RW 02 (Titik 1)',
            'type' => 'garden',
            'lat' => -6.615763, 
            'lng' => 106.775560,
            'description' => 'Penghijauan lahan sempit menggunakan teknik vertikal di wilayah RW 02.'
        ],
        [
            'name' => 'Vertical Garden RW 03 (Titik 2)',
            'type' => 'garden',
            'lat' => -6.612735, 
            'lng' => 106.777631,
            'description' => 'Lokasi kedua vertical garden sebagai perluasan zona hijau RW 03.'
        ],
        [
            'name' => 'Vertical Garden RW 04',
            'type' => 'garden',
            'lat' => -6.609205, 
            'lng' => 106.777155,
            'description' => 'Inisiatif taman vertikal warga RW 04 untuk kemandirian pangan/obat.'
        ],
    ];

    foreach ($locations as $location) {
        \App\Models\Location::create($location);
    }
}
}
