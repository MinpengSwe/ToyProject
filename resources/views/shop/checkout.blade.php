@extends('layouts.master')

@section('title')
    Laravel Shopping cart
@endsection


<!--payment is verified by 3rd party stripe-->
@section('content')
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
            <h1>Checkout</h1>
            <h4>Your Total: ${{$total}}</h4>

            <!--this div section is placed before opening the form and it checks whether the session has an error -->
            <!--if there is no error, the div section is hided, otherwise output an error if there is-->
            <!--class="alert alert-danger is boostrap class-->
            <div id="charge-error" class="alert alert-danger {{!Session::has('error') ? 'hidden' : ''}}">
                {{Session::get('error')}}
            </div>
            <form action="{{route('checkout')}}" method="post" id="checkout-form">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <!--added name attribute "name" in order to be used in ProductController.php-->
                            <!--in $order->name = $request->input('name'); -->
                            <input type="text" id="name" class="form-control" name="name" required >
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <!--added name attribute "address" in order to be used in ProductController.php-->
                            <!--in $order->address = $request->input('address'); -->
                            <input type="text" id="address" class="form-control" name="address" required>
                        </div>
                    </div>
                    <hr>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="card-name">Card Holder Name</label>
                            <input type="text" id="card-name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="card-number">Credit Card Number</label>
                            <input type="text" id="card-number" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="card-expiry-month">Expiration Month</label>
                                    <input type="text" id="card-expiry-month" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="card-expiry-year">Expiration Year</label>
                                    <input type="text" id="card-expiry-year" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="card-cvc">CVC</label>
                            <input type="text" id="card-cvc" class="form-control" required>
                        </div>
                    </div>
                </div>
                {{csrf_field()}}
                <button type="submit" class="btn btn-success">Buy now</button>
            </form>
        </div>
    </div>
@endsection

<!--this section imports stripe.js-->
@section('scripts')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <!--include my own checkout.js-->
    <script type="text/javascript" src="{{URL::to('js/checkout.js')}}"></script>
@endsection