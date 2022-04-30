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

        $sale = Sale::create([
            'user_id'       => $request->user_id,
            'total_amount'  => $total_amount,
            'amount_paid'   => $request->amount_paid,
            'status_id'     => $this->getStatus($request->amount_paid, $total_amount),
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
        $sale = Sale::findOrFail($id);
        return view('Sales.show', get_defined_vars());
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
    private function moneyToNumber($value) {
		$valueWithoutSignDollar = explode("$", $value);
		$valueWhitoutComas = str_replace(",", "", $valueWithoutSignDollar[1]);

		return (float)$valueWhitoutComas;
	}


    /**
     * Update current sale payment
     * @param  \Illuminate\Http\Request  $request
     */
    public function updatePay(Request $request){
        $sale = Sale::findOrFail($request->sale_id);

        $sale->update([
            'status_id'     => $this->getStatus($request->amount_paid, $request->total_amount),
            'amount_paid'   => $sale->amount_paid + $request->amount_paid,
        ]);

        return response()->json(202);
    }


    /**
     * Get sale status
     * 
     * @param double $amount_paid
     * @return integer $status_id
     */
    private function getStatus($amount_paid, $total_amount){
        if ($amount_paid <= 0)
            return 1;
        elseif ($amount_paid > 0 && $amount_paid < $total_amount)
            return 2;
        return 3;
    }
}
