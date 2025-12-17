<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_Answers extends Model
{
    protected $fillable = ['points', 'is_correct', 'answer', 'category', 'exam_order', 'user_id', 'question_id'];
}
