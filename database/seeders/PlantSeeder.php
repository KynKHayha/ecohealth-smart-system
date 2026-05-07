<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlantSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('plants')->truncate();

        DB::table('plants')->insert([
            // --- KATEGORI HIPERTENSI ---
            [
                'nama_tanaman' => 'Daun Seledri',
                'nama_latin' => 'Apium graveolens',
                'kategori' => 'Hipertensi',
                'manfaat' => 'Membantu menurunkan tekanan darah tinggi melalui efek diuretik alami[cite: 9, 21].',
                'cara_olah' => 'Rebus daun seledri segar secukupnya, minum air rebusannya secara rutin[cite: 14, 16].',
                'slug' => 'daun-seledri',
                'created_at' => now(),
            ],
            [
                'nama_tanaman' => 'Jahe',
                'nama_latin' => 'Zingiber officinale',
                'kategori' => 'Hipertensi',
                'manfaat' => 'Meningkatkan sirkulasi darah dan membantu relaksasi otot pembuluh darah[cite: 9].',
                'cara_olah' => 'Geprek jahe, seduh dengan air panas, dapat ditambahkan madu.',
                'slug' => 'jahe-hipertensi',
                'created_at' => now(),
            ],
            [
                'nama_tanaman' => 'Kumis Kucing',
                'nama_latin' => 'Orthosiphon aristatus',
                'kategori' => 'Hipertensi',
                'manfaat' => 'Membantu menurunkan tekanan darah dan memperlancar buang air kecil[cite: 12].',
                'cara_olah' => 'Seduh daun kumis kucing kering dengan air mendidih seperti teh.',
                'slug' => 'kumis-kucing-hipertensi',
                'created_at' => now(),
            ],
            [
                'nama_tanaman' => 'Bawang Putih',
                'nama_latin' => 'Allium sativum',
                'kategori' => 'Hipertensi',
                'manfaat' => 'Mengandung alisin yang membantu mengencerkan darah dan menurunkan tekanan.',
                'cara_olah' => 'Dikonsumsi mentah (1-2 siung) atau dicampurkan ke dalam masakan.',
                'slug' => 'bawang-putih',
                'created_at' => now(),
            ],
            [
                'nama_tanaman' => 'Daun Kelor',
                'nama_latin' => 'Moringa oleifera',
                'kategori' => 'Hipertensi',
                'manfaat' => 'Kaya antioksidan untuk menjaga elastisitas pembuluh darah.',
                'cara_olah' => 'Bisa diolah menjadi sayur bening atau teh daun kelor kering.',
                'slug' => 'daun-kelor',
                'created_at' => now(),
            ],

            // --- KATEGORI ASAM URAT ---
            [
                'nama_tanaman' => 'Kunyit',
                'nama_latin' => 'Curcuma longa',
                'kategori' => 'Asam Urat',
                'manfaat' => 'Kurkumin sebagai anti-inflamasi meredakan nyeri sendi akibat asam urat.',
                'cara_olah' => 'Parut kunyit, ambil airnya, rebus sebentar dan minum hangat.',
                'slug' => 'kunyit',
                'created_at' => now(),
            ],
            [
                'nama_tanaman' => 'Daun Salam',
                'nama_latin' => 'Syzygium polyanthum',
                'kategori' => 'Asam Urat',
                'manfaat' => 'Membantu menurunkan kadar asam urat tinggi dalam darah.',
                'cara_olah' => 'Rebus 7-10 lembar daun salam dengan 3 gelas air hingga sisa 1 gelas.',
                'slug' => 'daun-salam',
                'created_at' => now(),
            ],
            [
                'nama_tanaman' => 'Binahong',
                'nama_latin' => 'Anredera cordifolia',
                'kategori' => 'Asam Urat',
                'manfaat' => 'Meredakan nyeri sendi dan pegal linu akibat asam urat.',
                'cara_olah' => 'Rebus daun binahong segar, minum airnya secara teratur.',
                'slug' => 'binahong',
                'created_at' => now(),
            ],
            [
                'nama_tanaman' => 'Sidaguri',
                'nama_latin' => 'Sida rhombifolia',
                'kategori' => 'Asam Urat',
                'manfaat' => 'Membantu meluruhkan kristal asam urat pada persendian.',
                'cara_olah' => 'Rebus bagian akar atau daun sidaguri untuk diminum.',
                'slug' => 'sidaguri',
                'created_at' => now(),
            ],

            // --- KATEGORI DIABETES ---
            [
                'nama_tanaman' => 'Sambiloto',
                'nama_latin' => 'Andrographis paniculata',
                'kategori' => 'Diabetes',
                'manfaat' => 'Membantu menurunkan kadar gula darah (Solusi Diabetes)[cite: 9, 21].',
                'cara_olah' => 'Rebus daun sambiloto kering, minum airnya secara teratur[cite: 16].',
                'slug' => 'sambiloto',
                'created_at' => now(),
            ],
        ]);
    }
}