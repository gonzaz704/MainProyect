@extends('layouts.main')

@section('content')
    <div class="header">
        <h1><a href="{{ $data['permalink'] }}">{{ $data['title'] }}</a></h1>
    </div>

    @foreach ($data['items'] as $key => $item)
        <div class="item">
            <h2><a href="{{ $item->get_permalink() }}">{{ $item->get_title() }}</a></h2>
            <p>{!! $item->get_description() !!} </p>
            @if(isset($sentiments_for_news[$key]))
                <p>Sentiments : {{implode(",", $sentiments_for_news[$key])}}</p>
            @endif
            <p>
                <small>Posted on {{ $item->get_date('j F Y | g:i a') }}</small>
            </p>
        </div>
    @endforeach
@endsection
