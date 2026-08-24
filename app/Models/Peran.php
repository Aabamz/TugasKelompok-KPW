<?php

namespace App\Models;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> 79064e9 (migration-zabran)
use Illuminate\Database\Eloquent\Model;

class Peran extends Model
{
<<<<<<< HEAD
    protected $table = 'peran';

    protected $fillable = [
        'film_id',
        'cast_id',
        'nama',
    ];

    public function film()
    {
        return $this->belongsTo(Film::class);
=======
    use HasFactory;

    protected $table = 'peran';
    protected $fillable = ['film_id', 'cast_id', 'nama'];

    public function film()
    {
        return $this->belongsTo(Film::class, 'film_id');
>>>>>>> 79064e9 (migration-zabran)
    }

    public function cast()
    {
<<<<<<< HEAD
        return $this->belongsTo(Cast::class);
=======
        return $this->belongsTo(Cast::class, 'cast_id');
>>>>>>> 79064e9 (migration-zabran)
    }
}