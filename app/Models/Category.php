<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get the categories for the product
     */    
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * Check if the category exists
     */    
    public static function exist($categoryName)
    {
        $category = Category::whereRaw('upper(name) = upper("'.$categoryName.'")')->first();
        return $category;
    }

    /**
     * Store category
    * @return Category $category
     */    
    public static function saveCategory($categoryName){
        $category = Category::exist($categoryName);
        
        if(is_null($category))
            $category = Category::create(['name' => $categoryName]);
        return $category;
    }
}
