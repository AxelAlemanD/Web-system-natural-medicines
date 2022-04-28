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
}
