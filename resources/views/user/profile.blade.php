@extends('layouts.master')

@section('content')
    <div>
        <div class="col-md-8 col-md-offset-2">
            <h1>User profile</h1>
            <hr>
            <h2>My Orders</h2>
            <!--here use panel components from getboostrap.com-->
            @foreach($orders as $order)
            <div class="panel panel-default">
                <div class="panel-body">
                    <!--here uses list group components from getboostrap.com-->
                    <ul class="list-group">
                        @foreach($order->cart->items as $item)
                        <li class="list-group-item">
                            <span class="badge">{{$item['price']}} SEK</span>
                            {{$item['item']['name']}} | {{$item['qty']}} Units
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="panel-footer">
                    <strong>Total Price: {{$order->cart->totalPrice}}SEK</strong>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection