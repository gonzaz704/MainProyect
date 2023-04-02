@if ($chart)
    <div class="post-slide">
        <div class="post-content">

            <h3 class="post-title"><a href="{{ route('chart.details', ['id' => $chart->id]) }}">{{ $chart->title }}</a></h3>
            <div class="post-description">
                <img style="max-width: 100%;max-height: 30%" src="{{asset('storage'.$chart->template) }}" alt="image">
                <p>Source name: {{ $chart->author }}</p>
                <p>Source Website: {{ $chart->author_email }}</p>
                
                <p>Descripition: {!! str_limit($chart->topic,'100',
                        '...<a href="' .  route('chart.view',['id' => $chart->id]) .'">Read More</a>')
                    !!}
                </p>
                <p>Total Match : {{ $total }} </p>
            </div>
        </div>
    </div>
    </div>
@else
    <div class="post-slide">
        <div class="post-content">
            <div class="post-description">
                <p>No Match found.</p>
                <p>Total Match : {{ $total }} </p>
            </div>
        </div>
    </div>
    </div>
@endif
