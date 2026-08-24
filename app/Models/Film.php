<?php

namespace App\Models;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> 79064e9 (migration-zabran)
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
<<<<<<< HEAD
    protected $table = 'film';

    protected $fillable = [
        'judul',
        'ringkasan',
        'tahun',
        'poster',
        'genre_id',
    ];

    public function peran()
    {
        return $this->hasMany(Peran::class);
=======
    use HasFactory;

    protected $table = 'film';
    protected $fillable = ['judul', 'ringkasan', 'tahun', 'poster', 'genre_id'];

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id');
    }

    public function peran()
    {
        return $this->hasMany(Peran::class, 'film_id');
>>>>>>> 79064e9 (migration-zabran)
    }

    public function kritik()
    {
<<<<<<< HEAD
        return $this->hasMany(Kritik::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
=======
        return $this->hasMany(Kritik::class, 'film_id');
>>>>>>> 79064e9 (migration-zabran)
    }
}