@extends('layouts.main')
@inject('paper_helper','App\Helpers\PaperHelper')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="post-slide">
                <div class="post-content">
                    <h3 class="post-title">
                        <a href="{{  url('chart/' . $chart->id . '/view') }}">
                            {{ $chart->title }}
                        </a>
                    </h3>
                    <div class="post-description">
                        <img style="max-width: 100%;max-height: 30%" src="{{asset('storage'.$chart->template) }}" alt="image">
                        <p>Source name: {{ $chart->author }}</p>
                        <p>Source Website: {{ $chart->author_email }}</p>

                        <p>Descripition: {!! str_limit($chart->topic,'100',
                        '...<a href="' .  route('chart.view',['id' => $chart->id]) .'">Read More</a>')
                    !!}
                        </p>

                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="news-slider owl-carousel owl-theme ">
                @foreach ($chart->news as $news)
                    <div class="post-slide">
                        <div class="post-content">
                            <a href="{{ route('news.details', $news->id) }}">
                                <h3 class="">{{ $news->title }}</h3>
                            </a>
                            <img style="max-width: 100%" src="{{ $news->image }}" alt="">
                            <p class="post-description">
                                {{ substr($news->content_without_html_tags, 0, 50) }}
                            </p>
                            <ul class="post-bar">
                                <li><i class="fa fa-calendar"></i>
                                    {{ img_src($news->source) }} | {{ format_date($news->date) }}
                                </li>
                                <li>
                                    <i class="fa fa-folder"></i>
                                     {{  implode(',',$news->tags->pluck('title')->toArray()) }}
                                </li>
                                <li>
                                    <i class="fa fa-share-alt"></i>
                                    <a href="{{ route('data.share', ['id' => $news->id]) }}">Share</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
