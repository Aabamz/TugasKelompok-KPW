<?php

namespace App\Models;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> 79064e9 (migration-zabran)
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
<<<<<<< HEAD
    protected $table = 'genre';

    protected $fillable = [
        'nama',
    ];

    public function film()
    {
        return $this->hasMany(Film::class);
=======
    use HasFactory;

    protected $table = 'genre';
    protected $fillable = ['nama'];

    public function film()
    {
        return $this->hasMany(Film::class, 'genre_id');
>>>>>>> 79064e9 (migration-zabran)
    }
}