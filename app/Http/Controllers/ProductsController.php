<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('categories')->get();
        return view('Products.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('Products.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        if ($request->hasFile('url_image')) {
            $image = Product::saveImage($request->file('url_image'));
            $request->merge(['url_image' => $image['filename']]);
        }

        $product = Product::create($request->all());
        
        if($request->url_image != null){
            $product->url_image = 'images/' . $image['name'];
        }
        
        $product->save();

        foreach ($request->categories as $category) {
            $category = Category::saveCategory($category);
            $product->categories()->attach($category);
        }
        
        return redirect()->route('productos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('Products.show', get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('Products.create', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $oldProduct = $product; // Make a copy of the old product


        // Generate image url
        if ($request->hasFile('url_image')) {
            $image = Product::saveImage($request->file('url_image'));
            $request->merge(['url_image' => $image['filename']]);
        }

        // Update product information
        $product->update([
            'name'          => $request->name,
            'description'   => $request->description,
            'price'         => $request->price,
            'quantity'      => $request->quantity,
        ]);
        
        // Update product image url
        if($request->url_image != null){
            $product->url_image = 'images/' . $image['name'];
        }

        $product->save();

        
        // Add and remove categories
        foreach ($request->categories as $category) {
            $category = Category::saveCategory($category);
            // If the product does not have the category, it is added
            if (!($product->hasAnyCategory($category->name))) {
                $product->categories()->attach($category);
            }
            // The categories it already contains are removed from the old product
            $oldProduct->categories = $oldProduct->removeCategory($category);
        }

        // Remove relation
        foreach ($oldProduct->categories as $category) {
            $category->pivot->delete();
        }

        return redirect()->route('productos.index');
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
}
