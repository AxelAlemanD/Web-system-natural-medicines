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


    /**
     * Check if current product has any category
     * @param string $category
     * @return bool
     */
    public function hasAnyCategory($category)
    {
        return null !== $this->categories()->where('name', $category)->first();
    }

    /**
     * Remove the active categories of the current product
     * @param string $category
     * @return bool
     */
    public function removeCategory($category)
    {
        $this->categories = $this->categories->filter(function ($item) use($category) {
            if ($item->name != $category->name) {
                return $item;
            }
        });
        return $this->categories;
    }

    
    /**
     * Get price in currency format
     */
    public function getPrice()
    {
        return '$' . number_format($this->price, 2);
    }

    /**
     * Get price in currency format
     */
    public function getTotal($quantity)
    {
        return '$' . number_format($this->price * $quantity, 2);
    }


    /**
     * Generate url and save image
     */
    public static function saveImage($file)
    {
        $name = time() . $file->getClientOriginalName();
        $file->move(public_path() . '/images/', $name);
        $filename = $file->getClientOriginalName();

        return collect(['filename' => $filename, 'name' => $name]);
    }
}
