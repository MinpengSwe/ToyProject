@extends('layouts.layout')
@section('title')
    Create new Product
@stop

@section('body')
    <form action="/product" method="post" >
        {{csrf_field()}}
        Product name: <input type="text" name="pname"><br>
        Price: <input type="text" name="price"><br>
        <input type="submit" value="Submit">
    </form>


@stop