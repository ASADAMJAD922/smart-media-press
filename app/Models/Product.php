<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'author_id',
        'image',
        'price',
        'discount_price',
        'description',
    ];

    // Product → Category (belongs to)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Optional: Product → Author (if author table exists)
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
