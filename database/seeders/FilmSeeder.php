<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;
use App\Models\Film;

class FilmSeeder extends Seeder
{
    public function run()
    {
        // 1. Buat Data Genre Terlebih Dahulu
        $genre = Genre::firstOrCreate([
            'nama' => 'Action'
        ]);

        // 2. Buat Data Film Menggunakan ID Genre yang Baru Dibuat
        Film::create([
            'judul' => 'Inception',
            'ringkasan' => 'Seorang pencuri yang mencuri rahasia perusahaan melalui penggunaan teknologi berbagi mimpi.',
            'tahun' => 2010,
            'poster' => 'posters/sample.jpg',
            'genre_id' => $genre->id
        ]);
    }
}