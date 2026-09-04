<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Factories\HasFactory;
=======
<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> 79064e9 (migration-zabran)
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
<<<<<<< HEAD
=======
<<<<<<< HEAD
    protected $table = 'genre';

    protected $fillable = [
        'nama',
    ];

    public function film()
    {
        return $this->hasMany(Film::class);
=======
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021
    use HasFactory;

    protected $table = 'genre';
    protected $fillable = ['nama'];

    public function film()
    {
        return $this->hasMany(Film::class, 'genre_id');
<<<<<<< HEAD
=======
>>>>>>> 79064e9 (migration-zabran)
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021
    }
}