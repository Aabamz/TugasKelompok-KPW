<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;
use App\Models\Film;
use App\Models\Cast;
use App\Models\Peran;

class FilmSeeder extends Seeder
{
    public function run()
    {
        // 1. Buat Beberapa Data Genre
        $action = Genre::firstOrCreate(['nama' => 'Action']);
        $scifi  = Genre::firstOrCreate(['nama' => 'Sci-Fi']);
        $drama  = Genre::firstOrCreate(['nama' => 'Drama']);

        // 2. Buat Beberapa Data Film
        $inception = Film::firstOrCreate(
            ['judul' => 'Inception'],
            [
                'ringkasan' => 'Seorang pencuri yang mencuri rahasia perusahaan melalui penggunaan teknologi berbagi mimpi.',
                'tahun'     => 2010,
                'poster'    => 'posters/sample.jpg',
                'genre_id'  => $scifi->id,
            ]
        );

        $darkKnight = Film::firstOrCreate(
            ['judul' => 'The Dark Knight'],
            [
                'ringkasan' => 'Batman berhadapan dengan Joker, seorang kriminal jenius yang ingin membawa kekacauan ke Gotham City.',
                'tahun'     => 2008,
                'poster'    => 'posters/sample.jpg',
                'genre_id'  => $action->id,
            ]
        );

        $interstellar = Film::firstOrCreate(
            ['judul' => 'Interstellar'],
            [
                'ringkasan' => 'Sekelompok penjelajah menggunakan lubang cacing untuk menempuh jarak antar galaksi demi kelangsungan hidup manusia.',
                'tahun'     => 2014,
                'poster'    => 'posters/sample.jpg',
                'genre_id'  => $drama->id,
            ]
        );

        // 3. Buat Beberapa Data Cast
        $leo = Cast::firstOrCreate(
            ['nama' => 'Leonardo DiCaprio'],
            ['umur' => 49, 'bio' => 'Aktor asal Amerika Serikat, dikenal lewat berbagai peran dramatis.']
        );

        $christian = Cast::firstOrCreate(
            ['nama' => 'Christian Bale'],
            ['umur' => 50, 'bio' => 'Aktor asal Wales yang dikenal lewat perannya sebagai Batman.']
        );

        $matthew = Cast::firstOrCreate(
            ['nama' => 'Matthew McConaughey'],
            ['umur' => 55, 'bio' => 'Aktor peraih Academy Award asal Amerika Serikat.']
        );

        // 4. Hubungkan Cast dengan Film melalui Peran
        Peran::firstOrCreate(['film_id' => $inception->id, 'cast_id' => $leo->id], ['nama' => 'Dom Cobb']);
        Peran::firstOrCreate(['film_id' => $darkKnight->id, 'cast_id' => $christian->id], ['nama' => 'Bruce Wayne / Batman']);
        Peran::firstOrCreate(['film_id' => $interstellar->id, 'cast_id' => $matthew->id], ['nama' => 'Joseph Cooper']);
    }
}
