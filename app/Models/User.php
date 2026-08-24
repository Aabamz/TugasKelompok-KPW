<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

<<<<<<< HEAD
    /**
     * Relasi ke model Profile.
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function kritik()
    {
        return $this->hasMany(Kritik::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
=======
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    public function profile()
>>>>>>> 79064e9 (migration-zabran)
    {
        return $this->hasOne(Profile::class, 'user_id');
    }

    public function kritik()
    {
        return $this->hasMany(Kritik::class, 'user_id');
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
