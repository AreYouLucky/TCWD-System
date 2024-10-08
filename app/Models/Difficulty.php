<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Difficulty extends Model
{
    protected $table = 'difficulties';
    protected $primaryKey = 'difficulty_id';
    protected $fillable = [
        'name',
        'score',
        'round',
        'time'
    ];
}
