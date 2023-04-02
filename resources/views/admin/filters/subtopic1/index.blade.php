@extends('layouts.main')

@section('content')  
@foreach($subtopic1 as $subtopics1)
           <tr>
             
           <a href="subtopic2"><td>{{ $subtopics1->name }}</td></a>
           </tr>
@endforeach
@endsection