<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'url_image',
        'price',
        'quantity',
    ];

    /**
     * Get the comments for the product.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the likes for the product.
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Get the categories for the product
     */    
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Get the sales for the product
     */    
    public function sales()
    {
        return $this->belongsToMany(Sale::class)
                    ->withPivot('quantity');
    }

}