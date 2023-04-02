@extends('layouts.main')
@inject('ChartHelper', 'App\Helpers\ChartHelper')
@inject('paper_helper', 'App\Helpers\PaperHelper')
@inject('news_helper', 'App\Helpers\NewsHelper')

@section('meta-tags')
    <style>
        .badge-secondary {
            font-size: 11px;
            color: #fff;
            background-color: #6c757d;
            border-radius: 10px;
            padding: 3px 8px;
        }
    </style>
@endSection

@section('content')
    <div class="row">
        <form method="GET" action="/">
            <div class="col-md-3">
                <div class="form-group">
                    <select name="country" class="form-control" id="country-news">
                        <option value="">@lang('dashboard.country') </option>
                        @foreach ($countries as $country)
                            <option value="{{ $country }}"
                                {{ isset($data['country']) && $data['country'] == $country ? 'selected' : null }}>
                                {{ $country }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <select name="source" class="form-control" id="select-news-source">
                        <option value="">@lang('dashboard.source') </option>
                        @foreach ($sources as $source)
                            <option value={{ $source->id }}
                                {{ isset($data['source']) && $data['source'] == $source->id ? 'selected' : null }}>
                                {{ $source->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">@lang('dashboard.Filter')</button>
                    @auth
                        @can('Manage My News')
                            <a href="{{ route('my-news.create') }}" class="btn btn-primary">
                                @lang('dashboard.addNews')
                            </a>
                        @endcan
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">@lang('dashboard.addNews')</a>
                    @endauth
                </div>
            </div>
        </form>
        <div class="alert alert-primary hidden" role="alert">

        </div>
        <div class="col-md-12">
            <div class="news-data-slider owl-carousel owl-theme">
                @forelse($records as $news)
                    <div class="post-slide">
                        <div class="post-content">
                            @php $hasTag = false @endphp
                            @if (!empty($news->tags->toArray()))
                                @php $hasTag = true @endphp
                            @endif
                            <h3 class="post-title">
                                <a target={{ $hasTag ? '_self' : '_blank' }}
                                    href={{ $hasTag ? "#news-$news->id" : $news->url }}>
                                    {{ $news->title }}
                                </a>
                            </h3>
                            <img height="200px" width="200px" src="{{ $news->image }}" alt="">
                            <p class="post-description">
                                <span class="less-desc">
                                    {{ str_limit($news->content_without_html_tags, $limit = 100, $end = '...') }}
                                    <a href="javascript:void(0);" class="see-more-desc" data-id="{{ $news->id }}">See more</a>
                                </span>
                                <span class="full-desc" style="display: none;">
                                    {{ $news->content_without_html_tags }}
                                    <a href="javascript:void(0);" class="see-less-desc" data-id="{{ $news->id }}">See less</a>
                                </span>
                            </p>
                            <ul class="post-bar">
                                <li><i class="fa fa-calendar"></i>
                                    {{ img_src($news->news_source->title ?? '') }} | {{ format_date($news->date) }}
                                </li>
                                <li>
                                    <i class="fa fa-folder"></i>
                                    {{ implode(',', $news->tags->pluck('name')->toArray()) }}
                                </li>
                                @auth
                                    <li>
                                        <button type="button" data-route="{{ route('news.data.edit', $news->id) }}"
                                            class="btn btn-primary" data-toggle="modal" data-target="#newsDataModal">
                                            @lang('dashboard.AddData')
                                        </button>
                                    </li>
                                @else
                                    <li>
                                        <a style="color:#fff;" type="button" class="btn btn-primary" href="/login">
                                            @lang('dashboard.AddData')
                                        </a>
                                    </li>
                                @endauth
                            </ul>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
    @foreach ($tags as $tag)
        <div class="row mt-1 mb-2">
            <h3 class="text-capitalize text-xs-center">{{ $tag->name }}</h3>
            <div class="col-md-6">
                <div class="tagged-news-slider owl-carousel owl-theme ">
                    @foreach ($tag->news as $tag_news)
                        <div id="news-{{ $tag_news->id }}" class="post-slide" data-news={{ $tag_news->id }}>
                            <div class="post-content">
                                <span class="badge badge-pill badge-secondary">
                                    {{ $loop->iteration }} / {{ $tag->news->count() }}
                                </span>
                                <a href="{{ route('news.details', $tag_news->id) }}">
                                    {{-- Size of the title of the news matched --}}
                                    <h5 class="">{{ $tag_news->title }}</h5>
                                </a>
                                <img style="max-width: 100%" src="{{ $tag_news->image }}" alt="">
                                <p class="post-description">
                                    <span class="less-desc">
                                        {{ str_limit($tag_news->content_without_html_tags, $limit = 50, $end = '...') }}
                                        <a href="javascript:void(0);" class="see-more-desc" data-id="{{ $tag_news->id }}">See more</a>
                                    </span>
                                    <span class="full-desc" style="display: none;">
                                        {{ $tag_news->content_without_html_tags }}
                                        <a href="javascript:void(0);" class="see-less-desc" data-id="{{ $tag_news->id }}">See less</a>
                                    </span>
                                    <!-- {{ substr($tag_news->content_without_html_tags, 0, 50) }} -->
                                </p>
                                <ul class="post-bar">
                                    <li><i class="fa fa-calendar"></i>
                                        {{ img_src($tag_news->source) }} | {{ format_date($tag_news->date) }}
                                    </li>
                                    <li>
                                        <i class="fa fa-folder"></i>
                                        {{ implode(',', $tag_news->tags->pluck('name')->toArray()) }}
                                    </li>
                                    <li>
                                        <i class="fa fa-share-alt"></i>
                                        <a href="{{ route('data.share', ['id' => $tag_news->id]) }}">Share</a>
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
    @endforeach
    <div class="modal fade" id="newsDataModal" tabindex="-1" role="dialog" aria-labelledby="newsDataModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="text-align:center" class="modal-title" id="exampleModalLabel">@lang('dashboard.AddDataTitle')</h4>
                    <h5 style="text-align:center">@lang('dashboard.AddDataText')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('dashboard.CloseButton')</button>
                </div> --}}
            </div>
        </div>
    </div>
@endsection

@section('js_scripts')
    <script>
        $('#country-news').on('change', function(e) {
            e.preventDefault();
            var country = this.value;

            $.ajax({
                type: 'POST',
                url: "{{ route('newsSource.byCountry') }}",
                data: {
                    country: country
                },
                success: function(data) {
                    $('#select-news-source').empty().append(data.html);
                }
            });
        });

        $('.see-more-desc').on('click', function() {
            var me = $(this);
            var postDesc = me.closest('.post-description');
            console.log('desc', postDesc);
            postDesc.find('.less-desc').hide();
            postDesc.find('.full-desc').show();
        });

        $('.see-less-desc').on('click', function() {
            var me = $(this);
            var postDesc = me.closest('.post-description');
            postDesc.find('.full-desc').hide();
            postDesc.find('.less-desc').show();
        });
    </script>
@endsection
