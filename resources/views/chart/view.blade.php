@extends('layouts.main')
@section('content')
    <div class="col-sm-12">
        <div class="card item">
            <h5 class="card-header card-title">{{ $chart->title }}</h5>
            <div class="paper-slider owl-carousel owl-theme">
                <div id="expandable-container-paper" class="expandable-container item card-block">
                    @if($chart->template)
                    <div class="item">
                        <img class="card-img-top img-responsive"  height="300" width="100%" src="{{ asset('storage/' . $chart->template) }}"
                                alt="Card image cap">
                    </div>
                @endif
                    <span class="item pappers-list__body" aria-expanded="false">
                        {!! $chart->topic !!}                               
                    </span>
                    @if(strlen($chart->topic) > 400)
                        <a role="button" class="expandable-container__show-more content-collapsed" href="#expandable-container-paper"></a> 
                    @endif
                </div>
            </div>
            <ul class="list-group list-group-flush">
                @foreach(range(1,9) as $topic)  
                    @php
                        $fieldname = $topic;
                    @endphp
                    @if($chart->$fieldname != "")
                        <li id="expandable-container-paper-conclusion{{$topic}}" class="list-group-item">
                            <h5>Conclusion {{ $topic }} :</h5>
                            <div class="expandable-container">
                                <span class="item pappers-list__body" aria-expanded="false">                                        
                                    {{ $chart->$fieldname }}
                                </span>
                                @if(strlen($chart->$fieldname) > 400)
                                    <a role="button" class="expandable-container__show-more content-collapsed" href="#expandable-container-paper-conclusion{{$topic}}"></a> 
                                @endif
                            </div>
                        </li>
                    @endif
                @endforeach 
            </ul>
            {{-- <div class="card-block">
                <p class="card-title">Author : {{ $chart->author }}</p>
            </div> --}}
        </div>
    </div>
@endsection
