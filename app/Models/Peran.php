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

class Peran extends Model
{
<<<<<<< HEAD
=======
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
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021
    use HasFactory;

    protected $table = 'peran';
    protected $fillable = ['film_id', 'cast_id', 'nama'];

    public function film()
    {
        return $this->belongsTo(Film::class, 'film_id');
<<<<<<< HEAD
=======
>>>>>>> 79064e9 (migration-zabran)
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021
    }

    public function cast()
    {
<<<<<<< HEAD
        return $this->belongsTo(Cast::class, 'cast_id');
=======
<<<<<<< HEAD
        return $this->belongsTo(Cast::class);
=======
        return $this->belongsTo(Cast::class, 'cast_id');
>>>>>>> 79064e9 (migration-zabran)
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021
    }
}