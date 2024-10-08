<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $table = 'score_logs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'total_score',
        'user_id',
        'difficulty_id'
    ];
}
