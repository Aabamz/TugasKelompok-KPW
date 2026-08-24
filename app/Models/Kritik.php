<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kritik extends Model
{
    protected $table = 'kritik';

    protected $fillable = [
        'user_id',
        'film_id',
        'content',
        'point',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function film()
    {
        return $this->belongsTo(Film::class);
    }
}