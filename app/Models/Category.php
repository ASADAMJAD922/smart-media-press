<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'image',
        'is_active',
    ];

    // Category → Products (One to Many)
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
