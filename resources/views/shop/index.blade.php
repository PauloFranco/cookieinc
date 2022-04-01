@extends('layouts.app')

@section('title', make_title('Cookie Inc'))

@section('header')
    @include('shop.partials.header', [
        'game' => null,
        'title'  => 'Recipe',
        'except' => [ 'view' ],
    ])
@endsection

@section('content')
  
<p>This is where the recipe will go</p

    @foreach($ingredients as $ingredient)
        <p>{{$ingredient}}</p>
    @endforeach

    <p> best cookies are {{$best_cookies}}
    <p> best cookies are {{$best_diet_cookies}}

@endsection
