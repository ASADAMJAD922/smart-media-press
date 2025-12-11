<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AuthorQuestion extends Pivot
{
    protected $table = 'author_question'; // correct table

    protected $fillable = [
        'author_id',
        'question_id',
    ];

    public $timestamps = true;
}
