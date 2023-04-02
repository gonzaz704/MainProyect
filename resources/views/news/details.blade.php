@extends('layouts.main')
@inject('paper_helper', 'App\Helpers\PaperHelper')
@section('meta-tags')
    <!-- Twitter metadata -->
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:url" content="{{ $url }}">
    <meta name="twitter:image" content="{{ $image }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="{{ $site }}">
    <meta name="twitter:creator" content="{{ $site }}">
    <meta name="twitter:description" content="{{ $description }}">

    <!-- Whatsapp metadata -->
    <meta property="og:site_name" content="{{ $site }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:url" content="{{ $url }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ $image }}">
    <meta property="og:image:url" content="{{ $image }}">
    <meta property="og:image:secure_url" content="{{ $image }}">

    <!-- Facebook metadata -->
    <meta property="fb:app_id" content="2692744637443434">

    <style>
        .badge-secondary {
            font-size: 11px;
            color: #fff;
            background-color: #6c757d;
            border-radius: 10px;
            padding: 3px 8px;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="post-slide">
                <div class="post-content">
                    <a href="{{ $news->url }}" target="_blank">
                        <h3 class="">{{ $news->title }}</h3>
                    </a>
                    <img style="max-width: 100%" src="{{ $news->image }}" alt="">
                    <p class="post-description">
                        <span class="less-desc">
                            {{ str_limit($news->content_without_html_tags, $limit = 50, $end = '...') }}
                            <a href="javascript:void(0);" class="see-more-desc" data-id="{{ $news->id }}">See more</a>
                        </span>
                        <span class="full-desc" style="display: none;">
                            {{ $news->content_without_html_tags }}
                            <a href="javascript:void(0);" class="see-less-desc" data-id="{{ $news->id }}">See less</a>
                        </span>
                        <!-- {{ substr($news->content_without_html_tags, 0, 50) }} -->
                    </p>
                    <ul class="post-bar">
                        <li><i class="fa fa-calendar"></i>
                            {{ img_src($news->source) }} | {{ format_date($news->date) }}
                        </li>
                        <li>
                            <i class="fa fa-folder"></i>
                            {{ implode(',', $news->tags->pluck('title')->toArray()) }}
                        </li>
                        <button class="btn btn-link btn-copy" data-href="{{ route('news.details', ['id' => $news->id]) }}">
                            <i class="fa fa-copy"></i> Copy
                        </button>
                        </li>
                        <li>
                            <i class="fa fa-share-alt"></i>
                            <a href="{{ route('data.share', ['id' => $news->id]) }}">Share</a>
                        </li>
                        <li>
                            <button type="button" data-route="{{ route('news.data.edit', $news->id) }}"
                                class="btn btn-primary" data-toggle="modal" data-target="#newsDataModal">
                                Add Data
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="news-slider owl-carousel owl-theme ">
                @php
                    $i = 1;
                    $total = $news->confirmedPapers()->count() + $news->papers()->count() + $news->charts()->count();
                @endphp
                @foreach ($news->confirmedPapers as $paper)
                    <div class="post-slide">
                        <div class="post-content">
                            <div class="pull-right">
                                <span class="badge badge-pill badge-secondary">
                                    {{ $i }} / {{ $total }}
                                </span>
                            </div>
                            <h3 class="post-title"><a href="http://localhost/papers">{{ $paper->titulo }}</a></h3>
                            <div class="post-description">
                                {!! str_limit($paper->abstract, '1400', '...<a href="' . route('paper.view', $paper->id) . '">Read More</a>') !!}
                                </p>
                            </div>
                        </div>
                    </div>
                    @php $i++; @endphp
                @endforeach
                @foreach ($news->papers as $paper)
                    <div class="post-slide">
                        <div class="post-content">
                            <div class="pull-right">
                                <span class="badge badge-pill badge-secondary">
                                    {{ $i }} / {{ $total }}
                                </span>
                            </div>
                            <h3 class="post-title">
                                <a href="{{ route('papers.details', ['id' => $paper->id]) }}">{{ $paper->titulo }}</a>
                            </h3>
                            <div class="post-description">
                                <!-- <p>Conclusion 1: {{ $paper->conclusiones_1 }}</p>
                                                                                            <p>Conclusion 2: {{ $paper->conclusiones_2 }}</p>
                                                                                            <p>Conclusion 3: {{ $paper->conclusiones_3 }}</p>-->
                                <p>
                                    {!! str_limit($paper->abstract, '800', '...<a href="' . route('paper.view', $paper->id) . '">Read More</a>') !!}
                                </p>

                                {{-- <p>Total Match: {{ $total }} </p> --}}
                                <div class="">
                                    <!--    <p>Discussions</p>-->
                                </div>
                                <ul class="post-bar">
                                    <li>
                                        <a style="color:#00A5A8;"
                                            href={{ route('papers.discuss', ['id' => $paper->id]) }}>Send to discussion</a>
                                    </li>
                                    <li>
                                        <a style="color:#00A5A8;"
                                            href={{ route('discussion.index', ['paper_id' => $paper->id]) }}>
                                            View discussions</a>
                                    </li>
                                    <li>
                                        <button class="btn btn-link btn-copy"
                                            data-href="{{ route('news.details', ['id' => $news->id]) }}?paper={{ $paper->id }}">
                                            <i class="fa fa-copy"></i> Copy
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @php $i++; @endphp
                @endforeach
                @foreach ($news->charts as $chart)
                    <div class="post-slide">
                        <div class="post-content"> 
                            <div class="pull-right">
                                <span class="badge badge-pill badge-secondary">
                                    {{ $i }} / {{ $total }}
                                </span>
                            </div>
                            <h3 class="post-title"><a href="#">{{ $chart->title }}</a></h3>
                            <div class="post-description">
                                <!-- style="max-width: 100%;max-height: 30%" -->
                                <a href="{{ asset('storage' . $chart->template) }}" target="_blank" rel="No image found!">
                                    <img src="{{ asset('storage' . $chart->template) }}" alt="image">
                                </a>
                                <p>Source name: {{ $chart->author }}</p>
                                <p>Source Website: {{ $chart->author_email }}</p>
                                <p>Tags:
                                    @php
                                        $tgs = $chart->tags->pluck('name')->toArray();
                                        echo implode(', ', $tgs);
                                    @endphp
                                </p>
                                <p>Descripition: {!! str_limit($chart->topic, '100', '...<a href="' . route('chart.view', $chart->id) . '">Read More</a>') !!}
                                </p>
                            </div>
                            <ul class="post-bar">
                                <li>
                                    <button class="btn btn-link btn-copy"
                                        data-href="{{ route('news.details', ['id' => $news->id]) }}?chart={{ $chart->id }}">
                                        <i class="fa fa-copy"></i> Copy
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @php $i++; @endphp
                @endforeach
            </div>
        </div>
        <div class="modal fade" id="newsDataModal" tabindex="-1" role="dialog" aria-labelledby="newsDataModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
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

    @section('js_scripts')
        <script>
            $(document).ready(function() {
                $('.btn-copy').on('click', function() {
                    copyToClipboard($(this).data('href'));
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
            });

            function copyToClipboard(text) {
                const elem = document.createElement('textarea');
                elem.value = text;
                document.body.appendChild(elem);
                elem.select();
                document.execCommand('copy');
                document.body.removeChild(elem);
            }
        </script>
    @endsection
