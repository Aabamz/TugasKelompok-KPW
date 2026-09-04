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

class Kritik extends Model
{
<<<<<<< HEAD
    use HasFactory;

    protected $table = 'kritik';
    protected $fillable = ['user_id', 'film_id', 'parent_id', 'content', 'point'];
=======
<<<<<<< HEAD
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
=======
    use HasFactory;

    protected $table = 'kritik';
    protected $fillable = ['user_id', 'film_id', 'content', 'point'];
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
<<<<<<< HEAD
=======
>>>>>>> 79064e9 (migration-zabran)
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021
    }

    public function film()
    {
<<<<<<< HEAD
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
=======
<<<<<<< HEAD
        return $this->belongsTo(Film::class);
=======
        return $this->belongsTo(Film::class, 'film_id');
>>>>>>> 79064e9 (migration-zabran)
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021
    }
}