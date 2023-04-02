@extends('layouts.papers')
@inject('paper_helper', 'App\Helpers\PaperHelper')
@section('content')
    {{-- @forelse($papers->groupBy('creado_por_id') as $user_id => $groups) --}}
    @if(!empty($papers))

        @foreach ($papers as $key => $paper)
            <?php $clsname = get_class($paper); ?>
            @if ($clsname == 'App\Papers')
            @php $user = $paper_helper->getUserById($paper->creado_por_id) @endphp
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-block">
                                <h5 class="card-title">
                                    <a
                                        href="{{ route('dashboard.search.papers', ['user_id' => $user->id ?? '']) }}">{{ $user->name ?? '' }}</a>
                                </h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $user->email ?? '' }}</h6>
                                <p class="card-text">
                                <ul class="list-group">

                                    {{-- <li class="list-group-item">Author : {{ $paper->author_name }}</li>

                                    <li class="list-group-item">Tutors : {{ $paper->tutors }}</li>
                                    <li class="list-group-item">Total Publications :
                                        {{ $user ? $user->papers->count() : '' }}</li>
                                    <li class="list-group-item">Followers : {{ $user ? $user->followers->count() : '' }}
                                    </li>
                                    <!--<li class="list-group-item">Impact Factor : {{ '60' }}</li>-->
                                    <li class="list-group-item">Credits :
                                        @if ($user && $user->userrank)
                                            {{ $user->userrank->point }}
                                        @else
                                            0
                                        @endif
                                    </li> --}}
                                </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        @if ($paper)
                            <div class="card">
                                <h5 class="card-header card-title">
                                    {{-- @if ($paper->link_investigacion)
                                        <a href="{{ $paper->link_investigacion }}" target="_blank">{{ $paper->titulo }}</a>
                                    @else
                                        {{ $paper->titulo }}
                                    @endif --}}
                                    <a href="{{ url('paper/'.$paper->id.'/view') }}" target="_blank">{{ $paper->titulo }}</a>
                                </h5>
                                <div class="paper-slider owl-carousel owl-theme">
                                    <div id="expandable-container-paper" class="expandable-container item card-block">
                                        <span class="item pappers-list__body" aria-expanded="false">
                                            {!! $paper->abstract !!}
                                        </span>
                                        @if (strlen($paper->abstract) > 400)
                                            <a role="button" class="expandable-container__show-more content-collapsed"
                                                href="#expandable-container-paper"></a>
                                        @endif
                                    </div>
                                    @if (is_array($paper->ruta_grafico))
                                        @foreach ($paper->ruta_grafico as $image)
                                            <div class="item">
                                                <a href="{{ url('/images/' . $image) }}" target="_blank">
                                                    <img class="card-img-top img-responsive"
                                                        src="{{ url('/images/' . $image) }}" alt="Card image cap"
                                                        width="100%" height="200">
                                                </a>
                                            </div>
                                        @endforeach
                                    @else
                                        @if ($paper->ruta_grafico)
                                            <div class="item">
                                                <a href="{{ url('/images/' . $paper->ruta_grafico) }}" target="_blank">
                                                    <img class="card-img-top img-responsive"
                                                        src="{{ url('/images/' . $paper->ruta_grafico) }}" alt="Card image cap"
                                                        width="100%" height="200">
                                                </a>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                                <ul class="list-group list-group-flush">
                                    @foreach (range(1, 9) as $value)
                                        @php
                                            $fieldname = 'conclusiones_' . $value;
                                        @endphp
                                        @if ($paper->$fieldname != '')
                                            <li id="expandable-container-paper-conclusion{{ $value }}"
                                                class="list-group-item">
                                                <h5>Conclusion {{ $value }} :</h5>
                                                <div class="expandable-container">
                                                    <span class="item pappers-list__body" aria-expanded="false">
                                                        {{ $paper->$fieldname }}
                                                    </span>
                                                    @if (strlen($paper->$fieldname) > 400)
                                                        <a role="button"
                                                            class="expandable-container__show-more content-collapsed"
                                                            href="#expandable-container-paper-conclusion{{ $value }}"></a>
                                                    @endif
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                                <ul class="post-bar">
                                    <li>{{ $paper->link_investigacion }}</li>
                                    <li><i class="fa fa-calendar"></i>
                                        {{ img_src($paper->source) }} | {{ format_date($paper->date) }} | <i
                                            class="fa fa-flag"></i> {{ $user->country ?? '' }}
                                    </li>
                                    <li>
                                        <i class="fa fa-folder"></i>
                                        {{ implode(',', $paper['tags']) }}
                                    </li>
                                    <li>
                                        <i class="fa fa-share-alt"></i>
                                        <a href={{ route('papers.discuss', ['id' => $paper->id]) }}>Send to discussion</a>

                                        <i class="fa fa-eye"></i>
                                        <a href={{ route('discussion.index', ['paper_id' => $paper->id]) }}>View
                                            discussions</a>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="row">
                    @php $user = $paper_helper->getUserById($paper->user_id) @endphp
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-block">
                                <h5 class="card-title">
                                    <a
                                        href="{{ route('dashboard.search.papers', ['user_id' => $user->id ?? '']) }}">{{ $user->name ?? '' }}</a>
                                </h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $user->email ?? '' }}</h6>
                                <p class="card-text">
                                <ul class="list-group">
                                    {{-- <li class="list-group-item">Source Name : {{ $paper->author }}</li>
                                    <li class="list-group-item">Source Website : {{ $paper->author_email }}</li> --}}
                                    {{-- <li class="list-group-item">Total Publications :
                                        {{ $user ? $user->papers->count() : '' }}</li>
                                    <li class="list-group-item">Followers : {{ $user ? $user->followers->count() : '' }}</li>
                                    <li class="list-group-item">Following : {{ $user ? $user->following->count() : '' }}</li>
                                    <!--<li class="list-group-item">Impact Factor : {{ '60' }}</li>-->
                                    <li class="list-group-item">Credits :
                                        @if ($user && $user->userrank)
                                            {{ $user->userrank->point }}
                                        @else
                                            0
                                        @endif
                                    </li> --}}
                                </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        @if ($paper)
                            <div class="card">
                                chart.view
                                <h5 class="card-header card-title">
                                    <a href="{{ route('chart.view',$paper->id) }}" target="_blank">{{ $paper->title }}</a>
                                </h5>
                                <div class="item">
                                    <a href="{{ url('storage/' . $paper->template) }}" target="_blank" class="d-flex justify-content-center">
                                        <img class="card-img-top img-responsive chart-image" src="{{ url('storage/' . $paper->template) }}" alt="Card image cap" width="100%">
                                    </a>
                                </div>
                                <div class="paper-slider owl-carousel owl-theme">
                                    <div id="expandable-container-paper" class="expandable-container item card-block">
                                        <span class="item pappers-list__body" aria-expanded="false">
                                            {!! $paper->topic !!}
                                        </span>
                                        @if (strlen($paper->topic) > 400)
                                            <a role="button" class="expandable-container__show-more content-collapsed"
                                                href="#expandable-container-paper"></a>
                                        @endif
                                    </div>
                                </div>
                                <ul class="list-group list-group-flush">
                                    @foreach (range(1, 9) as $value)
                                        @php
                                            $fieldname = 'conclusiones_' . $value;
                                        @endphp
                                        @if ($paper->$fieldname != '')
                                            <li id="expandable-container-paper-conclusion{{ $value }}"
                                                class="list-group-item">
                                                <h5>Conclusion {{ $value }} :</h5>
                                                <div class="expandable-container">
                                                    <span class="item pappers-list__body" aria-expanded="false">
                                                        {{ $paper->$fieldname }}
                                                    </span>
                                                    @if (strlen($paper->$fieldname) > 400)
                                                        <a role="button"
                                                            class="expandable-container__show-more content-collapsed"
                                                            href="#expandable-container-paper-conclusion{{ $value }}"></a>
                                                    @endif
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>

                                <ul class="post-bar">
                                    {{-- <li>{{ $paper->link_investigacion }}</li> --}}
                                    <li>{{ $paper->author }} | {{ $paper->author_email }}</li>
                                    <li><i class="fa fa-calendar"></i>
                                        {{ img_src($paper->source) }} | {{ format_date($paper->created_at) }} | <i
                                            class="fa fa-flag"></i> {{ $user->country ?? '' }}
                                    </li>
                                    <li>
                                        <i class="fa fa-folder"></i>
                                        @foreach ($paper->tags as $tg)
                                            {{ $tg->name . ',' }}
                                        @endforeach
                                    </li>
                                    <li>
                                        <i class="fa fa-share-alt"></i>
                                        <a href={{ route('papers.discuss', ['id' => $paper->id]) }}>Send to discussion</a>
                                        <i class="fa fa-eye"></i>
                                        <a href={{ route('discussion.index', ['paper_id' => $paper->id]) }}>View
                                            discussions</a>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    @else
        <h4>No papers found.</h4>
    @endif
@endsection

@section('js_scripts')
    <script>
        $(document).ready(function() {
            // $('img.chart-image').each(function() {
            //     console.log($(this).height());
            //     if ($(this).height() > 400) {
            //         $(this).attr('height', 400);
            //         $(this).removeAttr('width');
            //     }
            // });
        });
    </script>
@endsection