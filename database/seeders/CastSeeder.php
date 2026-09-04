<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CastSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cast')->insert([
            [
                'nama' => 'Reza Rahadian',
                'umur' => 37,
                'bio' => 'Aktor Indonesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Dian Sastrowardoyo',
                'umur' => 42,
                'bio' => 'Aktris Indonesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Nicholas Saputra',
                'umur' => 40,
                'bio' => 'Aktor Indonesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}