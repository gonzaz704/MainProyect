@extends('layouts.papers')
@section('content')
    @if(!empty($charts))
        @php 
            $chart = $charts->last();
            $user = ($chart->user) ? $chart->user : null;
        @endphp
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-block">
                        <h5 class="card-title">
                            <a href="{{ route('dashboard.search.papers',['user_id' => $user->id ?? '']) }}">{{ $user->name ?? '' }}</a>
                        </h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $user->email ?? '' }}</h6>
                        <p class="card-text">
                        <ul class="list-group">
                            
                            <li class="list-group-item">Source Name : {{ $chart->source_name }}</li>
                            <li class="list-group-item">Total Publications : {{ $user ? $user->papers->count() : '' }}</li>
                            <li class="list-group-item">Followers : {{ $user ?  $user->followers->count() : '' }}</li>
                            <li class="list-group-item">Credits : 
                                @if($user && $user->userrank)
                                    {{ $user->userrank->point }}
                                @else
                                0
                                @endif
                            </li>
                        </ul>
                        </p>
                    </div>
                </div>
            </div>            
            <div class="col-sm-8">
                @if($chart)
                    <div class="card">
                        <h5 class="card-header card-title">
                            {{ $chart->title }}
                        </h5>
                        <div class="item">
                            <img class="card-img-top img-responsive" src="{{ url('storage/'.$chart->template) }}"
                                    alt="Card image cap">
                        </div>
                        <div class="paper-slider owl-carousel owl-theme">
                            <div id="expandable-container-paper" class="expandable-container item card-block">
                                <span class="item pappers-list__body" aria-expanded="false">
                                    {!! $chart->topic !!}                               
                                </span>
                                @if(strlen($chart->topic) > 400)
                                    <a role="button" class="expandable-container__show-more content-collapsed" href="#expandable-container-paper"></a> 
                                @endif
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach(range(1,9) as $value)  
                                @php
                                    $fieldname = 'conclusiones_' . $value;
                                @endphp
                                @if($chart->$fieldname != "")
                                <li id="expandable-container-paper-conclusion{{$value}}" class="list-group-item">
                                    <h5>Conclusion {{ $value }} :</h5>
                                    <div class="expandable-container">
                                        <span class="item pappers-list__body" aria-expanded="false">                                        
                                            {{ $chart->$fieldname }}
                                        </span>
                                        @if(strlen($chart->$fieldname) > 400)
                                            <a role="button" class="expandable-container__show-more content-collapsed" href="#expandable-container-paper-conclusion{{$value}}"></a> 
                                        @endif
                                    </div>
                                </li>
                                @endif
                            @endforeach 
                        </ul>
                        <ul class="post-bar">
                            <li><i class="fa fa-calendar"></i>
                                {{ format_date($chart->date) }} | <i class="fa fa-flag"></i> {{ $user->country ?? '' }}
                            </li>
                            <li>
                                <i class="fa fa-folder"></i>
                                {{ implode(',',$chart['tags']) }}
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    @else
        <h4>No papers found.</h4>
    @endif
@endsection
