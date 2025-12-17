<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Daily_Attempts extends Model
{
    protected $fillable = ['attempts', 'category', 'user_id', 'date'];
}
