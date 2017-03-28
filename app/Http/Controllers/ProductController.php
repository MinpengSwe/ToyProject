<?php

namespace App\Http\Controllers;

//use Illuminate\Contracts\Session\Session;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Request;
use App\Product;
use App\Cart;
use App\Order;
use App\Http\Requests;
use App\User;
//use Auth;

use Session;
use Stripe\Stripe;

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

    public function getReduceByOne($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByone($id);

        if(count($cart->items) > 0){
            Session::put('cart', $cart);
        }else{
            Session::forget('cart'); //this removes the cart
        }

        return redirect()->route('product.shoppingCart');
    }

    public function getRemoveItem($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if(count($cart->items) > 0){
            Session::put('cart', $cart);
        }else{
            Session::forget('cart'); //this removes the cart
        }
        
        return redirect()->route('product.shoppingCart');
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

    public function postCheckout(Request $request)
    {
        if(!Session::has('cart')){
            return redirect()->route('shop.shoppingCart');
        }
        $oldCart = Session::get('cart');
        $cart=new Cart($oldCart);
        //this one use Stripe\Stripe at the top of the file
        Stripe::setApiKey('sk_test_hVh8ucRpY5eT7DPe3t1YsmKm');
        //create charge, example at https://stripe.com/docs/api/php#create_charge
        try{
            //or you can use Stripe\Charge at the top of the file, and then just Charge::create
            $charge=\Stripe\Charge::create(array(
                //stripe use cents as default unit, that is why we *100
                "amount" => $cart->totalPrice*100,
                "currency" => "sek",
                //stripeToken is the input name for form append in my checkout.js file
                "source" => $request->input('stripeToken'), // obtained with Stripe.js
                "description" => "Test Charge"
            ));
            $order=new Order();
            //serialize is a build in php function and it takes the cart object and convert it into a string
            $order->cart = serialize($cart);
            //get address and name value from checkout page inputs
            $order->address = $request->input('address');
            $order->name = $request->input('name');
            $order->payment_id = $charge->id;//u can find stripe documents to see there is an id attribute on Charge class

            //take authenticated user for orders attributes and save its relationship with order
            //Auth::user()->orders()->save($order);
            //dd(Auth::user());
            //dd(Auth::getUser());
            //dd(Sentinel::getUser()->id);
            $userId=Sentinel::getUser()->id;

            $user = User::find($userId);
            $user->orders()->save($order);//save the relationship
            //dd($user);
            //$user = Sentinel::findById(1);
            //dd($user);
            //Sentinel::getUser()->orders()->save($order);
        } catch (\Exception $e){
            return redirect()->route('checkout')->with('error', $e->getMessage());
        }
        //clear shopped items in cart
        Session::forget('cart');
        return redirect()->route('product.index')->with('success', 'Successfully purchased products!');
    }

}
