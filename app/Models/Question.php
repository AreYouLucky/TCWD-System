<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    protected $primaryKey = 'question_id';
    protected $fillable = [
        'question',
        'difficulty_id',
        'img_dir',
        'correct_ans',
        'category',
        'year_lvl',
        'status'
    ];

    public function choices(){
        return $this->hasMany(QuestionChoices::class,'question_id','question_id');
    }

    public function difficulty(){
        return $this->hasOne(Difficulty::class,'difficulty_id','difficulty_id');
    }
    
}
