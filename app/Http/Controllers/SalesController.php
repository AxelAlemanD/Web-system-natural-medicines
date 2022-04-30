<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Sale;
use App\Models\Product;
use App\Http\Requests\SaleRequest;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::all();
        return view('Sales.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $rol = Role::where('name', 'Cliente')->first();
        $customers = $rol->users;

        return view('Sales.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleRequest $request)
    {
        $total_amount = $this->moneyToNumber($request->total_amount);

        // Get status
        $status = 3;
        if ($request->amount_paid <= 0) {
            $status = 1;
        } elseif ($request->amount_paid > 0 && $request->amount_paid < $total_amount) {
            $status = 2;
        }
        

        $sale = Sale::create([
            'user_id'       => $request->user_id,
            'total_amount'  => $total_amount,
            'amount_paid'   => $request->amount_paid,
            'status_id'     => $status,
        ]);


        for ($i=0; $i < count($request->products); $i++) { 
            // Add relation
            $sale->products()->attach($request['products'][$i],
                                        ['product_id'   =>  $request['products'][$i], 
                                        'quantity'      =>  $request['quantities'][$i]
                                        
                                    ]);
            
            // Update product quantity
            $product = Product::findOrFail($request['products'][$i]);
            $product->quantity = $product->quantity - $request['quantities'][$i];
            $product->save();
        }

        return redirect()->route('ventas.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaleRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Convert a currency-formatted string to a float value
     * 
     * @param string $vaule
     * @return double $valueWithoutComas
     */
    public function moneyToNumber($value) {
		$valueWithoutSignDollar = explode("$", $value);
		$valueWhitoutComas = str_replace(",", "", $valueWithoutSignDollar[1]);

		return (float)$valueWhitoutComas;
	}
}
