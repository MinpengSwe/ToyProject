<?php

namespace App\Http\Controllers;

//use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Request;
use App\Product;
use App\Cart;
use App\Http\Requests;

use Session;

class ProductController extends Controller
{
    //
    public function index(){
        //this is using eloquent to fetch all rows in Product table
        $products = Product::all();
        //return $products;
        //return view('products.index')->with('products', $products);
        return view('shop.index')->with('products', $products);
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
        return redirect()->route('shop.index');
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
        return redirect()->route('shop.index');
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
        return redirect()->route('shop.index');
    }

    public function getAddToCart(Request $request, $id){
        $product = Product::find($id);
        //$oldCart = Session::has('cart') ? Session::get('cart') : null;
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);
        //dd($cart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        //dd($request->session()->get('cart'));
        return redirect()->route('product.index');
    }

    public function getCart(){
        if(!Session::has('cart')){
            return view('shop.shopping-cart', ['products' => null]);
        }
        $oldCart = Session::get('cart');
        $cart=new Cart($oldCart);
        return view('shop.shopping-cart',['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function getCheckout(){
        if(!Session::has('cart')){
            return view('shop.shopping-cart', ['products' => null]);
        }
        $oldCart = Session::get('cart');
        $cart=new Cart($oldCart);
        return view('shop.checkout', ['total'=>$cart->totalPrice]);
    }
}
