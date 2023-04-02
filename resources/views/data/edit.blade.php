@extends('layouts.main')
@inject('TagHelper', 'App\Helpers\TagHelper')
@set('chart',$TagHelper->getLatestChart($news))
@section('meta-tags')
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="{{ url('/') }}">
    <meta name="twitter:creator" content={{ env('APP_NAME') }}>
    <meta name="twitter:title" content="{{ $news->title }}">
    <meta name="twitter:description" content="{{ $news->content_without_html_tags }}">
    @if($chart_thumbnail)
        <meta name="twitter:image:src" content="{{ url($chart_thumbnail)}}">
    @elseif($paper_thumbnail)
        <meta name="twitter:image:src" content="{{ url($paper_thumbnail)}}">
    @else
        <meta name="twitter:image:src" content="{{ url($thumbnail)}}">
    @endif
    
    <meta property="og:type"   content="website" />
    <meta property="og:title" content="{{ $news->title }}" />
    <meta property="og:url" content="{{ url()->current() . "?fbclid" }}" />
    <meta property="og:description" content="{{ $news->content_without_html_tags }}" />
    @if($chart_thumbnail)
        <meta property="og:image" content="{{ url($chart_thumbnail) }}">
    @elseif($paper_thumbnail)
        <meta property="og:image" content="{{ url($paper_thumbnail) }}">
    @else
        <meta property="og:image" content="{{ url($thumbnail) }}">
    @endif
    <meta property="fb:app_id" content="2692744637443434">
@endsection
@section('content')
    <div class="container open-chart">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-12">
                                <h3><a href="{{ $news->url }}">{{ $news->title }}</a></h3>
                                <i>Posted on {{ $news->date}}</i>
                            </div>
                            <div class="col-md-{{ $chart ? '6' : '12'}}">
                                <img src="{{ $news->image }}" alt="">
                            </div>
                            <div class="col-md-6">
                                 @if ($chart)
                                    @if ($chart->type == '1')
                                        <img src="{{ $chart->template }}" alt="{{ $chart->title }}">
                                    @else
                                        @include('data.charts.' . $chart->template,['id' => $chart->id] )
                                    @endif
                                @endif
                            </div>
                            <div class="col-md-12">
                                <p>{!! $news->content_without_html_tags !!} </p>
                                <p>Sentiments : <span class="tags">  
                                       {{  implode(',',$news->tags->pluck('title')->toArray()) }}
                                </span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                <div class="social-div">
                    <a href="https://twitter.com/share"
                       class="twitter-share-button"
                       data-text ="Title:  {{$news->title}}, Tags:  {{  implode(',',$news->tags->pluck('title')->toArray()) }}"
                       data-size="large"
                       data-show-count="false">Tweet
                    </a>
                    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                    <iframe src="https://www.facebook.com/plugins/share_button.php?href={{ request()->url() }}&layout=button_count&size=large&width=106&height=28&appId" width="106" height="28" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection

