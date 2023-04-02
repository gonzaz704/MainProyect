@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h1 class="text-capitalize text-bold text-xs-center">Discussions  </h1>
    </div>
</div>
@forelse($records as $record)
<div class="row mt-1">
    @php $paper = $record->paper @endphp
    <div class="col-sm-5">
        <div class="post-slide">
            <div class="post-content">
                <h3 class="post-title">
                    <a href="{{ route('papers.details', ['id' => $paper->id]) }}">{{ $paper->titulo }}</a>
                </h3>
                <div class="post-description">
                    <p>
                        {!! str_limit($paper->abstract, '100', '...<a href="' . route('paper.view', ['id' => $paper->id]) . '">Read More</a>') !!}
                    </p>     
                    @foreach(range(1,9) as $value)  
                        @php
                            $fieldname = 'conclusiones_' . $value;
                        @endphp
                        @if($paper->$fieldname != "")
                            <div id="expandable-container-paper1-conclusion{{$value}}" class="list-group-item">
                                <h5>Conclusion {{ $value }} :</h5>
                                <div class="expandable-container">
                                    <span class="pappers-list__body" aria-expanded="false">                                        
                                        {{ $paper->$fieldname }}
                                    </span>
                                    @if(strlen($paper->$fieldname) > 200)
                                        <a role="button" class="expandable-container__show-more content-collapsed" href="#expandable-container-paper1-conclusion{{$value}}"></a> 
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach                          
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="d-flex justify-content-center align-items-center" style="min-height:200px">
            <a href={{ route('papers.discuss.show',['id' => $record->id]) }} class="btn btn-primary">Enter to discussion </a>
        </div>
    </div>
    <div class="col-sm-5">
        @php $paperdiscussion = $record->paperdiscussion()->with('paper')->latest()->first() @endphp
        @if($paperdiscussion)
            @php $paper = $paperdiscussion->paper @endphp
            @if($paper)
            <div class="post-slide">
                <div class="post-content">
                    <h3 class="post-title">
                        <a href="{{ route('papers.details', ['id' => $paper->id]) }}">{{ $paper->titulo }}</a>
                    </h3>
                    <div class="post-description">
                        <p>
                            {!! str_limit($paper->abstract, '100', '...<a href="' . route('paper.view', ['id' => $paper->id]) . '">Read More</a>') !!}
                        </p>
                        @foreach(range(1,9) as $value)
                            @php
                                $fieldname = 'conclusiones_' . $value;
                            @endphp
                            @if($paper->$fieldname != "")
                                <div id="expandable-container-paper2-conclusion{{$value}}" class="list-group-item">
                                    <h5>Conclusion {{ $value }} :</h5>
                                    <div class="expandable-container">
                                        <span class="pappers-list__body" aria-expanded="false">
                                            {{ $paper->$fieldname }}
                                        </span>
                                        @if(strlen($paper->$fieldname) > 200)
                                            <a role="button" class="expandable-container__show-more content-collapsed" href="#expandable-container-paper2-conclusion{{$value}}"></a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        @endif
    </div>
</div>
@empty
@endforelse

@endsection
