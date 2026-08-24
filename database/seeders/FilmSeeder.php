<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
        ]);
    }
}