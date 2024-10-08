<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'fname',
        'fname',
        'fname',
        'school_name',
        'region',
        'province',
        'city',
        'role',
        'img',
        'username',
        'password',
        'mac_id',
        'flag_quiz',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function earned_badges()
    {
        return $this->hasMany(BadgeEarned::class, 'user_id', 'user_id');
    }
}
