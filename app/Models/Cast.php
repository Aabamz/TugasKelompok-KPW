<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    protected $table = 'cast';

    protected $fillable = [
        'nama',
        'umur',
        'bio',
    ];

    public function peran()
    {
        return $this->hasMany(Peran::class);
    }
}