<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    //
    public function index(){
        //this is using eloquent to fetch all rows in Product table
        $products = Product::all();
        //return $products;
        return view('products.index')->with('products', $products);
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request)
    {
        //dd($request);
        $product = new Product;
        $product->name = $request->pname;
        $product->price = $request->price;
        $product->save();
        return redirect()->route('product.index');
        //second way to return to index page
        //return $this->index();
        //third way to return to index page
        //return redirect()->action('ProductController@index');
    }

    /*
     * show the form for editing the specified resource
     * */
    public function edit($id)
    {
        $product = Product::where('id', $id)->first();

        return view('products.edit', compact('product', $product));
    }

    /*
     * update the specified resource to storage
     */
    public function update(Request $request, $id)
    {
        //dd($id);
        $product=Product::find($id);
        $product->name=$request->pname;
        $product->price=$request->price;
        $product->save();
        return redirect()->route('product.index');
    }

    public function show($id)
    {
        $product = Product::find($id);
        return view('products.show')->with('product', $product);
    }

    public function destroy($id)
    {
        //dd($id);
        Product::destroy($id);
        return redirect()->route('product.index');
    }
}
