<?php

namespace App\Models;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> 79064e9 (migration-zabran)
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
<<<<<<< HEAD
    //
}
=======
    use HasFactory;

    protected $table = 'profile';
    protected $fillable = ['umur', 'bio', 'alamat', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
>>>>>>> 79064e9 (migration-zabran)
