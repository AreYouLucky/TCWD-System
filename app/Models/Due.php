<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Due extends Model
{
    protected $table = 'dues';
    protected $primaryKey = 'id';
    protected $fillable = [
        'days',
    ];
}
