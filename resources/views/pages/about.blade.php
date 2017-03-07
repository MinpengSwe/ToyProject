@extends('layouts.layout')

@section('title')
    About us
@stop

@section('body')
    <h1>This is the about page.</h1>
    <p>{{$name}}</p>

    @if($isUserRegistered == true)
        <p>Hello mate!</p>
    @else
        <p> Please register!</p>
    @endif

    @foreach($users as $user)
        This is user {{$user}}<br>
    @endforeach
@stop



