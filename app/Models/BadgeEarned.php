<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BadgeEarned extends Model
{
    protected $table = 'badge_earned';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'img',
        'badge_id'
    ];

    public function badge(){
        return $this->hasOne(Badge::class,'badge_id','badge_id');
    }
    
}
