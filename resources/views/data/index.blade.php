@extends('layouts.main')

@section('content')

    <!DOCTYPE html>
    <html>
    <head>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <title>jkhj</title>

    </head>
    <body>
        <div class="container open-chart">
            @foreach ($news as $key => $item)
                <?php $tags = explode(",", $item->tags)?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card" align="center">
                            <div class="card-block">
                                <h2><a href="{{ $item->url }}">{{ $item->title }}</a></h2>
                                <p>{!! $item->description !!} </p>
                                <p>Sentiments : {{$item->tags}}</p>
                                <p>
                                    <small>Posted on {{ $item->date}}</small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        @if($item->type  == 0 && $item->charts!='')
                           @include("data.charts.{$item->charts}", ['id' => $item->id])
                        @elseif($item->type  == 1)
                            <img src="{{url($item->charts)}}" alt="Image" width="488px" height="244px" >
                        @endif
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            @include('data.social-icons.contact-buttons')
                        </div>
                    </div>
            @endforeach
        </div>
    </body>
    </html>

@endsection

