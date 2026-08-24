<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KritikSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kritik')->insert([
            [
                'users_id' => 1,
                'film_id' => 1,
                'content' => 'Film ini sangat bagus dan ceritanya menarik.',
                'point' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'users_id' => 2,
                'film_id' => 1,
                'content' => 'Akting para pemain sangat bagus.',
                'point' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'users_id' => 1,
                'film_id' => 2,
                'content' => 'Ceritanya cukup menarik.',
                'point' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}