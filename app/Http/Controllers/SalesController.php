<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Sale;
use App\Models\User;
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

        // If the amount paid is greater than the total of the sale, the total of the sale is assigned
        if($request->amount_paid > $total_amount){
            $request->amount_paid = $total_amount;
        }

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
        // $sale = Sale::findOrFail($id);
        
        // $products = Product::all();
        // $rol = Role::where('name', 'Cliente')->first();
        // $customers = $rol->users;
        
        // return view('Sales.create', get_defined_vars());
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
        $newAmountPaid = $sale->amount_paid + $request->amount_paid;

        $sale->update([
            'status_id'     => $this->getStatus($newAmountPaid, $sale->total_amount),
            'amount_paid'   => $newAmountPaid,
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
        else
            return 3;
    }


    /**
     * Get all customers users
     * @param  \Illuminate\Http\Request  $request
     * @return json $customers
     */
    public function getCustomers(Request $request){
        $rol = Role::where('name', 'Cliente')->first();
        $customers = $rol->users;

        return response()->json(['customers' => $customers]);
    }

    /**
     * cChange the customer to which the sale belongs
     * @param  \Illuminate\Http\Request  $request
     * @param  integer $id
     * @return response $customer
     */
    public function changeCustomer(Request $request, $id){
        $sale = Sale::findOrFail($id);
        $customer = User::findOrFail($request->new_customer);

        $sale->update(['user_id' => $request->new_customer]);
        
        return response()->json(['customer' => $customer]);
    }


    /**
     * Return a product from a sale
     * @param  \Illuminate\Http\Request  $request
     * @param  integer $id
     * @return response 202
     */
    public function returnProduct(Request $request, $id){
        $sale           = Sale::findOrFail($id);
        $product        = Product::findOrFail($request->product_id);
        $new_quantity   = $request->current_quantity - $request->refund_amount;
        $url            = null;

        // Modify product quantity
        if ($new_quantity > 0) {
            $sale->updateProductQuantity($request->product_id, $new_quantity);
        } else {
            $sale->removeProduct($request->product_id);
        }

        // If the sale has no products it is deleted
        if (count($sale->products) <= 0) {
            $sale->delete();
            $url = route('ventas.index');
        }
        // else update cost of sale
        else{
            $new_total = 0;
            foreach ($sale->products as $product) {
                $new_total += $product->pivot->quantity * $product->price;
            }
            $sale->update(['total_amount' => $new_total]);
        }
        
        // Updates the available quantity of the product in the inventory
        $product->update(['quantity' => $product->quantity + $request->refund_amount]);


        return response()->json(['url' => $url]);
    }
}
