<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
<<<<<<< HEAD
        // Akun Administrator
        User::factory()->create([
            'name'  => 'Admin',
            'email' => 'admin@example.com',
            'role'  => 'admin',
        ]);

        // Akun User Biasa (untuk testing)
        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
            'role'  => 'user',
        ]);

        // Data Film, Genre, Cast & Peran
        $this->call(FilmSeeder::class);
=======
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
>>>>>>> 79064e91894921fb0130794e5dc02db441f554a9
    }
}
