<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserSiproan extends Authenticatable
{
    use Notifiable;

    // Kolom yang bisa diisi
    protected $fillable = [
        'email',
        'password',
        'role',
    ];

    // Kolom yang harus disembunyikan
    protected $hidden = [
        'password',
    ];
}
