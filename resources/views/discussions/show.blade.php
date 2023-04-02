@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h1 class="text-capitalize text-bold text-xs-center">{{ $record->title }}  </h1>
        </div>
    </div>
    <div class="row">
        @php $paper = $record->paper @endphp
        <div class="post-slide col-sm-12 col-md-5">
            <div class="post-content">
                <h3 class="post-title">
                    <a href="{{ route('papers.details', ['id' => $paper->id]) }}">{{ $paper->titulo }}</a>
                </h3>
                <div class="post-description">                     
                    <p>
                        {!! str_limit($paper->abstract, '400', '...<a href="' . route('paper.view', ['id' => $paper->id]) . '">Read More</a>') !!}
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
        <div class="post-slide col-sm-12 col-md-5">
            @php $paperdiscussion = $record->paperdiscussion()->with('paper')->latest()->first() @endphp
            @if($paperdiscussion)
                @php $paper = $paperdiscussion->paper @endphp
                @if($paper)
                    <div class="post-content">
                        <h3 class="post-title">
                            <a href="{{ route('papers.details', ['id' => $paper->id]) }}">{{ $paper->titulo }}</a>
                        </h3>
                        <div class="post-description">
                            <p>
                                {!! str_limit($paper->abstract, '400', '...<a href="' . route('paper.view', ['id' => $paper->id]) . '">Read More</a>') !!}
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
                @endif
            @endif
        </div>
    </div>
    <div class="row mt-2">
        <form method="POST" action="{{ route('papers.discuss.comment', ['id' => $record->id]) }}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="editor">Add a comment</label>
                    <textarea type="text" class="form-control" id="editor" name="message"></textarea>
                </div>
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    @forelse($record->comments as $comment)
        <div class="row mt-1">
            <div class="col-sm-12">
                <div class="d-flex align-items-center" style="min-height:200px">
                    <img src="{{ $comment->user->avatar() }}" alt="avatar">
                    <fieldset class="paper-fieldset" style="width:100%">
                        <p class="text-italic">{{ $comment->created_at }}</p>
                        <h5 class="text-bold">{{ $comment->user->name }}</h5>
                        <p>{{ $comment->message }}</p>
                    </fieldset>
                </div>
            </div>
        </div>
    @empty
    @endforelse

@endsection
