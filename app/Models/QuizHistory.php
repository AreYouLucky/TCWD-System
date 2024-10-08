<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizHistory extends Model
{
    protected $table = 'quiz_histories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'question_id',
        'user_id',
        'score'
    ];
}
