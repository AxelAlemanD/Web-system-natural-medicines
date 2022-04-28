<?php

namespace Database\Seeders;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all();

        Sale::all()->each(function ($sale) use ($products){
            $sale->products()->attach(
                $products->random(1),
                ['product_id'   =>  $products[rand(1, 5)]->id, 
                'quantity'      =>  rand(1,25)]
            );
        });
    }
}
