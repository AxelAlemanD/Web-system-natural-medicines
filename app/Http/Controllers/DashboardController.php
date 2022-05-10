<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $start  =   Carbon::now()->startOfMonth();
        $end    =   Carbon::now()->endOfMonth();
    
        $totalSalesOfTheMonth       = Sale::whereBetween('updated_at', [$start, $end])->count();
        $totalEarningsOfTheMonth    = $this->numberToMoney(Sale::whereBetween('updated_at', [$start, $end])->sum('amount_paid'));
        $mostPurchasedProduct       = Product::withCount('sales')->orderBy('sales_count', 'desc')->first();
        $mostlikedProduct           = Product::withCount('likes')->orderBy('likes_count', 'desc')->first();
        $mostCommentedProduct       = Product::withCount('comments')->orderBy('comments_count', 'desc')->first();
        $earningsOfTheYear          = $this->get_earnings_of_the_year();
        $month                      = Carbon::now()->locale('es'); // Get month name in spanish


        return view('dashboard', get_defined_vars());
        
    }

     /**
     * Convert double to string
     *
     * @param  double  $value
     * @return string
     */
    public function numberToMoney($value){
        return '$' . number_format($value, 2);
    }



    public function get_earnings_of_the_month($month_start, $month_end){
        return Sale::whereBetween('updated_at', [$month_start, $month_end])->sum('amount_paid');
    }


    
    public function get_earnings_of_the_year(){
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        $profits = [];

        for ($i=0; $i < count($months); $i++) {
            $month_start = date('Y/m/d', strtotime('first day of ' . $months[$i] . ' this Year', time()));
            $month_end = date('Y/m/d', strtotime('last day of ' . $months[$i] . ' this Year', time()));

            $profits[] = $this->get_earnings_of_the_month($month_start, $month_end);
        }


        return $profits;
    }
    
}
