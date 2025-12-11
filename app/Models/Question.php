<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'question_text',
        'is_active',
    ];

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function authors()
    {
        return $this->belongsToMany(User::class, 'author_question', 'question_id', 'author_id')
            ->using(\App\Models\AuthorQuestion::class)
            ->withTimestamps();
    }
}
