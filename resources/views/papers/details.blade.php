@extends('layouts.main')
@inject('paper_helper','App\Helpers\PaperHelper')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="post-slide">
                <div class="post-content">
                    <h3 class="post-title">
                        <a href="{{ url('paper/' . $paper->id . '/view') }}">
                            {{ $paper->titulo }}
                        </a>
                    </h3>
                    <div class="post-description">
                        {{-- <p>Conclusion 1: {{ $paper->conclusiones_1 }}</p>
                        <p>Conclusion 2: {{ $paper->conclusiones_2 }}</p>
                        <p>Conclusion 3: {{ $paper->conclusiones_3 }}</p> --}}
                        <p>
                            {!! str_limit($paper->abstract, '1400', '...<a href="' . route('paper.view', ['id' => $paper->id]) . '">Read More</a>') !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="news-slider owl-carousel owl-theme ">
                @foreach ($paper->news as $news)
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

    @if($review)
    <div class="row">
        <div class="col-md-12">
            <form action={{ route('papers.feedback') }} method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="user_id" value="{{ $review->user_id }}">
                <input type="hidden" name="paper_id" value="{{ $review->paper_id }}">
                <div class="form-group">
                    <label for="editor">Feedback</label>
                    <textarea type="text" class="form-control" id="editor" name="description" required>{{  $feedback ? $feedback->description : "" }}</textarea>
                </div>
                <button type="submit" class="btn btn-default">Send</button>
            </form>
        </div>
    </div>
    @endif
@endsection
