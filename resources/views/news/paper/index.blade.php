@if ($paper)
    <div class="post-slide">
        <div class="post-content">
            <h3 class="post-title"><a
                    href="{{ route('papers.details', ['id' => $paper->id]) }}">{{ $paper->titulo }}</a></h3>
            <div class="post-description">
               <!-- <p>Conclusion 1: {{ $paper->conclusiones_1 }}</p>
                <p>Conclusion 2: {{ $paper->conclusiones_2 }}</p>
                <p>Conclusion 3: {{ $paper->conclusiones_3 }}</p>-->
                <p>
                    {!! str_limit($paper->abstract, '800', '...<a href="' . route('paper.view', ['id' => $paper->id]) . '">Read More</a>') !!}
                </p>

                <p>Total Match: {{ $total }} </p>
                <div class="">
                <!--    <p>Discussions</p>-->
                </div>
                <ul class="post-bar">
                    <li>
                        <a style="color:#00A5A8;" href={{ route('papers.discuss', ['id' => $paper->id]) }}>Send to discussion</a>
                    </li>
                    <li>
                        <a style="color:#00A5A8;" href={{ route('discussion.index', ['paper_id' => $paper->id]) }}>View discussions</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    </div>
@else
    <div class="post-slide">
        <div class="post-content">
            <div class="post-description">
                <p>No Match found.</p>
                <p>Total Match: {{ $total }} </p>
            </div>
        </div>
    </div>
    </div>
@endif
