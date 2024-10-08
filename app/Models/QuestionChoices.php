<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionChoices extends Model
{
    protected $table = 'question_choices';
    protected $primaryKey = 'choice_id';
    protected $fillable = [
        'question_id',
        'choice',
    ];
}
