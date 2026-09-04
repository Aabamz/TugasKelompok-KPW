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

class Film extends Model
{
<<<<<<< HEAD
    use HasFactory;

    protected $table = 'film';
    protected $fillable = ['judul', 'ringkasan', 'tahun', 'poster', 'video', 'genre_id'];
=======
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
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id');
    }

    public function peran()
    {
        return $this->hasMany(Peran::class, 'film_id');
<<<<<<< HEAD
=======
>>>>>>> 79064e9 (migration-zabran)
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021
    }

    public function kritik()
    {
<<<<<<< HEAD
        return $this->hasMany(Kritik::class, 'film_id');
    }

    // Hanya ulasan utama (bukan balasan) - dipakai untuk hitung rating
    public function ulasanUtama()
    {
        return $this->hasMany(Kritik::class, 'film_id')->whereNull('parent_id');
    }

    // User-user yang mem-wishlist film ini
    public function wishlistedBy()
    {
        return $this->belongsToMany(User::class, 'wishlists', 'film_id', 'user_id')->withTimestamps();
=======
<<<<<<< HEAD
        return $this->hasMany(Kritik::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
=======
        return $this->hasMany(Kritik::class, 'film_id');
>>>>>>> 79064e9 (migration-zabran)
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021
    }
}