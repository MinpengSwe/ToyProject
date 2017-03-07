@extends('layouts.layout')
@section('title')
    {{$product->name}}
@stop

@section('body')
    <form action = "{{url('/product/'. $product->id)}}" method="post">
        {{ method_field('DELETE') }}

        {{csrf_field()}}
    <h1>{{$product->name}}</h1>
    <h3>{{$product->price}}</h3>
    <a href="{{route('product.edit', $product->id)}}">Edit</a>

        <input type="submit" value="Delete">
    </form>
@stop