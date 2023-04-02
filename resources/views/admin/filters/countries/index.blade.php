@extends('layouts.main')

@section('content')  
@foreach($country as $countries)
           <tr>
           <a href="maintopic"><td>{{ $countries->id }}</td></a>
           <a href="maintopic"><td>{{ $countries->country }}</td></a>
           </tr>
@endforeach
@endsection