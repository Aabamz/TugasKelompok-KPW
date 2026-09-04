<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kritik extends Model
{
    use HasFactory;

    protected $table = 'kritik';
    protected $fillable = ['user_id', 'film_id', 'parent_id', 'content', 'point'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function film()
    {
        return $this->belongsTo(Film::class, 'film_id');
    }

    // Ulasan induk (kalau ini adalah balasan)
    public function parent()
    {
        return $this->belongsTo(Kritik::class, 'parent_id');
    }

    // Daftar balasan untuk ulasan ini
    public function replies()
    {
        return $this->hasMany(Kritik::class, 'parent_id')->with('user')->oldest();
    }
}