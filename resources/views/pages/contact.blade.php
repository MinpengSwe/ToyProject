@extends('layouts.layout')

@section('title')
    Contact
@stop

@section('body')
    <h1>This is the contact page.</h1>
    <input type="text">
    {!! Form::text('price', '50', [
        'class' => "form-control",
        'placeholder' => "Give a price"
    ]) !!}
@stop

