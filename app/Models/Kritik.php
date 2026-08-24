<?php

namespace App\Models;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> 79064e9 (migration-zabran)
use Illuminate\Database\Eloquent\Model;

class Kritik extends Model
{
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
>>>>>>> 79064e9 (migration-zabran)
    }

    public function film()
    {
<<<<<<< HEAD
        return $this->belongsTo(Film::class);
=======
        return $this->belongsTo(Film::class, 'film_id');
>>>>>>> 79064e9 (migration-zabran)
    }
}