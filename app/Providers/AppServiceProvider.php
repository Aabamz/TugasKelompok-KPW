<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::define('admin', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('user', function (User $user) {
            return $user->role === 'user';
        });
    }
<<<<<<< HEAD
}
=======
}
  // Update atau buat profile jika belum ada 
         // Update atau buat profile jika belum ada
          // Update atau buat profile jika belum ada
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021
