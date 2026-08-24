<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
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
    }

    public function kritik()
    {
        return $this->hasMany(Kritik::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}