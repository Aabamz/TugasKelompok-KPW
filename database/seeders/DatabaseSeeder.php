<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
<<<<<<< HEAD
        // Akun Administrator
=======
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021
        User::factory()->create([
            'name'  => 'Admin',
            'email' => 'admin@example.com',
            'role'  => 'admin',
        ]);

<<<<<<< HEAD
        // Akun User Biasa (untuk testing)
        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
            'role'  => 'user',
        ]);

        // Data Film, Genre, Cast & Peran
        $this->call(FilmSeeder::class);
=======
        User::factory()->create([
            'name' => 'Test User 2',
            'email' => 'test2@example.com',
        ]);

        $this->call([
            GenreSeeder::class,
            FilmSeeder::class,
            CastSeeder::class,
            PeranSeeder::class,
            KritikSeeder::class,
        ]);
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021
    }
}