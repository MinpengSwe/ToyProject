@extends('layouts.layout')
@section('title')
Edit    {{$product->name}}
@stop

@section('body')
    <form action = "{{url('/product/'. $product->id)}}" method="post">
        {{ method_field('PUT') }}
        {{csrf_field()}}
        Product name: <input type="text" name="pname" value="{{$product->name}}"><br>
        Price: <input type="text" name="price" value="{{$product->price}}"><br>

        <input type="submit" value="Update">
    </form>
@stop