@extends('layouts.main')
@inject('ChartHelper', 'App\Helpers\ChartHelper')
@inject('paper_helper','App\Helpers\PaperHelper')

@section('content')
    <div class="row">
        <div class="col-md-3 p-1 mr-1">
           <div class="form-group">
               <select name="country" id="news_country" class="form-control news-country" data-url="{{ route('news.country.change') }}">
                    @foreach($countries as $country)
                       <option value="{{ $country }}" {{ $country === $selected_country ? "selected" : "" }}>{{ $country }}</option>
                    @endforeach
               </select>
           </div>
        </div>
        <div class="alert alert-primary hidden" role="alert">

        </div>
        <div class="col-md-12">
            <div class="news-data-slider owl-carousel owl-theme">
                @forelse($records as $news)
                    <div class="post-slide">
                        <div class="post-content">
                            <h3 class="post-title"><a href="#">{{ str_limit($news->title, $limit = 60, $end = '...') }}</a></h3>
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
                                    <button type="button" data-route="{{ route('news.data.edit',$news->id) }}" class="btn btn-primary" data-toggle="modal" data-target="#newsDataModal">
                                        Add Data
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
    @foreach($tags as $tag)
        @if($tag->news->count() > 0)
            <div class="row mt-1 mb-2">
            <h3 class="text-capitalize text-xs-center">{{ $tag->title }}  </h3>
            <div class="col-md-6">
                <div class="tagged-news-slider owl-carousel owl-theme ">
                    @foreach ($tag->news as $news)
                        <div class="post-slide" data-news={{ $news->id }}>
                            <div class="post-content">
                                <a href="{{ route('news.details',$news->id) }}"><h3 class="">{{ $news->title }}</h3></a>
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
                                        <a href="{{ route('data.share',['id' =>$news->id]) }}">Share</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-6 news-popular-paper-container">
            </div>
        </div>
        @endif
    @endforeach
    <div class="modal fade" id="newsDataModal" tabindex="-1" role="dialog" aria-labelledby="newsDataModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <h5 class="modal-title" id="exampleModalLabel">Add/Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
