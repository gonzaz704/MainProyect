@extends('layouts.main')
@section('content')
    <div class="col-sm-12">
        <div class="post-slide">
            <div class="post-content">
                <h3 class="post-title"><a href="{{ $news->url }}" target="_blank">{{ $news->title }}</a></h3>
                <img src="{{ $news->image }}" alt="">
                <p class="post-description">
                    {{ $news->content_without_html_tags }}
                </p>
                <ul class="post-bar">
                    <li><i class="fa fa-calendar"></i>
                        {{ img_src($news->source) }} | {{ format_date($news->date) }}
                    </li>
                    <li>
                        <i class="fa fa-folder"></i>
                        {{ implode(',',$news->tags->pluck('name')->toArray())  }}
                    </li>
                    <li>
                        <i class="fa fa-share-alt"></i>
                        <a href="{{ route('data.share',['id' =>$news->id]) }}">Share</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
