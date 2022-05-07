<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'total_amount',
        'amount_paid',
        'status_id',
    ];


    /**
     * Get the user that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    /**
     * Get the sales for the product
     */    
    public function products()
    {
        return $this->belongsToMany(Product::class)
                    ->withPivot('quantity');
    }

    /**
     * Get the status that owns the Sale.
     */
    public function status(){
        return $this->belongsTo(Status::class);
    }


    /**
     * Get sale date
     */
    public function getDate(){
        return $this->created_at->format('d/m/Y');
    }

    /**
     * Get double in currency format
     */
    public function numberToCurrency($value){
        return '$' . number_format($value, 2);
    }

    /**
     * Get some products from the current sale
     */
    public function getSomeProducts(){
        foreach ($this->products->take(4) as $product) {
            print($product->pivot->quantity.' '.$product->name.', ');
        }
    }

    /**
     * Remove product from sale
     */
    public function removeProduct($product_id){
        $this->products()->detach($product_id);
    }

    /**
     * Update product quantity in current sale
     */
    public function updateProductQuantity($product_id, $quantity){
        $this->products()->updateExistingPivot($product_id, ['quantity' => $quantity]);
    }
}
