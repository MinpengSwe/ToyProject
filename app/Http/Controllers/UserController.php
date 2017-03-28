<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use App\User;

class UserController extends Controller
{
    //
    public function getProfile(){
        $userId=Sentinel::getUser()->id;
        //dd($userId);
        $user = User::find($userId);
        //dd($user);
        $orders = $user->orders;
        //dd($orders);
        //transform function is laravel function, allows me to edit each order in orders, cause we want to
        //unserialize the cart value in each order
        $orders->transform(function($order, $key){
            $order->cart=unserialize($order->cart);
            return $order;
        });
        return view('user.profile', ['orders'=>$orders]);
    }
}
