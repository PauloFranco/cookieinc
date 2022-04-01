@extends('layouts.app')

@section('title', make_title('Cookie Inc'))

@section('header')
   
@endsection

@section('content')
  
<h3>Available Ingredients</h3>
<table class="table">
    <thead>
      <tr>
        @foreach($ingredients->first()->getAttributes() as $key =>$attribute)
            <th>{{$key}}</th>
        @endforeach
      </tr>
    </thead>
    <tbody>
        @foreach($ingredients as $ingredient)
            <tr>
                @foreach($ingredient->getAttributes() as $attribute)
                    <td>{{$attribute}}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
  </table>
  
  <h2>Best score for a non-diet cookie is: {{$best_cookies[0]}}</h2>
  <h3>Best recipe dosage for said cookie is:</h3>
  <h4>
    @foreach($best_cookies[1] as $key => $value)
        {{$ingredients[$key]->name}} - {{$value}} spoons </br>
    @endforeach
   </h4>
    </br>
    </br>
    <h2>Best score for a diet cookie is: {{$best_diet_cookies[0]}}</h2>
    <h3>Best recipe dosage for said cookie is:</h3>
    <h4>
      @foreach($best_diet_cookies[1] as $key => $value)
          {{$ingredients[$key]->name}} - {{$value}} spoons </br>
      @endforeach
     </h4>
    

@endsection
