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

class Cast extends Model
{
<<<<<<< HEAD
=======
<<<<<<< HEAD
    protected $table = 'cast';

    protected $fillable = [
        'nama',
        'umur',
        'bio',
    ];

    public function peran()
    {
        return $this->hasMany(Peran::class);
=======
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021
    use HasFactory;

    protected $table = 'cast';
    protected $fillable = ['nama', 'umur', 'bio'];

    public function peran()
    {
        return $this->hasMany(Peran::class, 'cast_id');
<<<<<<< HEAD
=======
>>>>>>> 79064e9 (migration-zabran)
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021
    }
}