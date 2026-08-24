<?php

namespace App\Models;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> 79064e9 (migration-zabran)
use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
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
    use HasFactory;

    protected $table = 'cast';
    protected $fillable = ['nama', 'umur', 'bio'];

    public function peran()
    {
        return $this->hasMany(Peran::class, 'cast_id');
>>>>>>> 79064e9 (migration-zabran)
    }
}