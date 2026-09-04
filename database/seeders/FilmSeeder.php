<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
<<<<<<< HEAD
use App\Models\Genre;
use App\Models\Film;
use App\Models\Cast;
use App\Models\Peran;
=======
<<<<<<< HEAD
use Illuminate\Support\Facades\DB;

class FilmSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('film')->insert([
            [
                'judul' => 'Avengers',
                'ringkasan' => 'Sekumpulan superhero bekerja sama menyelamatkan dunia.',
                'tahun' => 2012,
                'poster' => 'avengers.jpg',
                'genre_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Mr Bean',
                'ringkasan' => 'Film komedi tentang kehidupan Mr Bean.',
                'tahun' => 2007,
                'poster' => 'mrbean.jpg',
                'genre_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
=======
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
>>>>>>> 79064e9 (migration-zabran)
        ]);
    }
}
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021
