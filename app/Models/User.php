<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use NotificationChannels\WebPush\HasPushSubscriptions;

class User extends Authenticatable
{
<<<<<<< HEAD
    use HasFactory, Notifiable, HasPushSubscriptions;

=======
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
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
<<<<<<< HEAD
        'avatar',
        'phone',
        'bio',
    ];

    public function profile()
=======
    ];

    public function profile()
>>>>>>> 79064e9 (migration-zabran)
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021
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
<<<<<<< HEAD
    }

    // User-user yang di-follow oleh dia
    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id')->withTimestamps();
    }

    // User-user yang follow dia
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id')->withTimestamps();
    }

    public function isFollowing(User $user): bool
    {
        return $this->following()->where('following_id', $user->id)->exists();
    }

    // Film-film yang di-wishlist oleh user ini
    public function wishlists()
    {
        return $this->belongsToMany(Film::class, 'wishlists', 'user_id', 'film_id')->withTimestamps();
    }

    public function hasWishlisted(Film $film): bool
    {
        return $this->wishlists()->where('film_id', $film->id)->exists();
=======
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021
    }
}
