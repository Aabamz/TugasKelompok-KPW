<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('genre')->insert([
            [
                'nama' => 'Action',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Comedy',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Horror',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}