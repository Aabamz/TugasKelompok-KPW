<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeranSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('peran')->insert([
            [
                'film_id' => 1,
                'cast_id' => 1,
                'nama' => 'Budi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'film_id' => 1,
                'cast_id' => 2,
                'nama' => 'Siti',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'film_id' => 2,
                'cast_id' => 3,
                'nama' => 'Andi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}