<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = [
        'question_id',
        'name',
        'text',
        'is_correct',
        'is_active',
    ];
}
