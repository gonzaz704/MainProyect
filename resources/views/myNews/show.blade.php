@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-2">
            <div class="col align-self-center">
                <h3>Show News Details</h3>
            </div>
            <div class="col align-self-center">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
            </div>
        </div>

        <div class="post-slide">
            <div class="post-content">
                <h3 class="post-title"><a href="{{ $news->url }}" target="_blank">{{ $news->title }}</a></h3>
                <img style="max-width: 100%" src="{{ $news->image }}" alt="">
                <p class="post-description">
                    {{ $news->content_without_html_tags }}
                </p>
                <ul class="post-bar">
                    <li><i class="fa fa-calendar"></i>
                        {{ img_src($news->news_source->title) }} | {{ format_date($news->date) }}
                    </li>
                    <li>
                        <i class="fa fa-folder"></i>
                        {{ implode(',', $news->tags->pluck('title')->toArray()) }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
