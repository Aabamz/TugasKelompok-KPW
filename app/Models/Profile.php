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

class Profile extends Model
{
<<<<<<< HEAD
    use HasFactory;

    protected $table = 'profile';
    protected $fillable = ['umur', 'bio', 'alamat', 'social_links', 'user_id'];
    protected $casts = ['social_links' => 'array'];
=======
<<<<<<< HEAD
    //
}
=======
    use HasFactory;

    protected $table = 'profile';
    protected $fillable = ['umur', 'bio', 'alamat', 'user_id'];
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 79064e9 (migration-zabran)
>>>>>>> d24e364a9782d2a0de58826f07610dd5dbfb1021
