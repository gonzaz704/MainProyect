@extends('layouts.main')

@section('content')  
@foreach($maintopic as $MainsTopics)
           <tr>
              <!--  <td>{{ $MainsTopics->id }}</td> -->
           <a href="subtopic1"><td>{{ $MainsTopics->name }}</td></a>
           </tr>
@endforeach
@endsection