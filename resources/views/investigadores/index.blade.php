@extends('layouts.main')

@section('content')
    
    @foreach($investigadores as $investigando)


<div class="center-block">
        <div class="card pull-right" style="width:900px" align="center">
            <div class="card-block">
                <h4 class="card-title">{{$investigando->nombre_investigadores}}</h4>

                 @endforeach
     
@endsection