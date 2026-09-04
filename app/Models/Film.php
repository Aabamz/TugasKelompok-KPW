<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $table = 'film';
    protected $fillable = ['judul', 'ringkasan', 'tahun', 'poster', 'video', 'genre_id'];

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id');
    }

    public function peran()
    {
        return $this->hasMany(Peran::class, 'film_id');
    }

    public function kritik()
    {
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
    }
}