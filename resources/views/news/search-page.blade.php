@extends('layouts.main')
@section('content')
    @forelse($records as $news)
        <div class="row">        
            <div class="col-md-12">            
                <div class="post-slide">
                        <div class="post-content">
                            @php $hasTag = false @endphp
                            @if (!empty($news->tags->toArray()))
                                @php $hasTag = true @endphp
                            @endif
                            <h3 class="post-title">
                                <a target={{ $hasTag ? '_self' : '_blank' }} href={{ $hasTag ? "#news-$news->id" : $news->url }}>
                                    {{ substr($news->title, 0, 100) }}
                                </a>
                            </h3>
                            <img height="200px" width="200px" src="{{ $news->image }}" alt="">
                            <p class="post-description">
                                {{ substr($news->content_without_html_tags, 0, 50) }}
                            </p>
                            <ul class="post-bar">
                                <li>
                                    <i class="fa fa-calendar"></i>
                                    {{ img_src($news->source) }} | {{ format_date($news->date) }}
                                </li>
                                <li>
                                    <i class="fa fa-folder"></i>
                                    {{ implode(',', $news->tags->pluck('title')->toArray()) }}
                                </li>
                            </ul>
                        </div>
                </div>                
            </div>
        </div>
    @empty
        No records found
    @endforelse
    
    {{ $records->appends($_GET)->links() }}
@endsection
