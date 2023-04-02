{{-- <ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" role="tab"  href="#news">@lang('dashboard.Newstopics')</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" role="tab"  href="#charts">@lang('dashboard.Charts')</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" role="tab"  href="#papers">@lang('dashboard.Papers')</a>
    </li>
</ul>
<div class="tab-content">
    <div class="tab-pane active" id="news">
        @include('news_data.partials.news')
    </div>
    <div class="tab-pane" id="charts">
        @include('news_data.partials.charts')
    </div>
    <div class="tab-pane" id="papers">
        @include('news_data.partials.papers')
    </div>
</div> --}}
@inject('paper_helper', 'App\Helpers\PaperHelper')
@inject('tag_helper', 'App\Helpers\TagHelper')
@php $users = $paper_helper->getUsers() @endphp

<div class="container mt-1">
    <form method="POST" id="popupform" action="{{ action('NewsController@update', $news->id) }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @php $selected = $news->tags->pluck('id')->toArray() ?? []; @endphp
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <h5><label for="tags_{{ $news->id }}">@lang('dashboard.NewsTopic')</label> </h5>
                    <select data-url={{ route('filter.tags') }} name="tags[]" class="tag-selector topics"
                        id="tags_{{ $news->id }}" multiple="multiple" required> Aca entra el input unico de "News
                        topic".. Cambiarlo por cada opcion de TOPIC
                        @foreach ($tags as $key => $tag)
                            @if ($tag->is_news_tags)
                                <option value="{{ $tag->id }}"
                                    {{ in_array($tag->id, $selected) ? 'selected' : '' }}>
                                    {{ $tag->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <p class="tag-helper"></p>
                </div>
            </div>
        </div>
        <br>
        @php $selected = $news->charts->pluck('id')->toArray() ?? []; @endphp
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <h5><label for="tags">@lang('dashboard.SelectCharts2')</label> </h5>
                    <select name="charts[]" class="tag-selector" id="news-data-charts" id="charts" multiple="multiple" required>
                        @foreach ($charts as $key => $chart)
                            <option value="{{ $key }}" {{ in_array($key, $selected) ? 'selected' : '' }}>
                                {{ $chart }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        {{-- <form method="POST" id="chart-filter" action="{{ route('chart.filter') }}" enctype="multipart/form-data"> --}}
            {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
            {{--Chart filters--}}
            {{-- <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="hashtags">@lang('dashboard.FilterByTopics')</label>
                        <select name="tags[]" id="chart_tags" class="form-control tag-selector" multiple>
                            @foreach ($tag_helper->dropdown() as $tag)
                                @if ($tag->is_charts_tags && $tag->status == 1)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="link_investigacion">@lang('dashboard.CountryChoosingPapers')</label>
                        @include('auth.partials.country', ['value' => request()->query('country')])
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="link_investigacion">@lang('dashboard.AuthorChoosingPapers')</label>
                        <select name="user_id" class="form-control" id="chart_user_id" value=""> </br>
                            <option value="">@lang('dashboard.ChoosingAuthors')</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <button type="button" id="chart-filter" class="btn btn-default">@lang('dashboard.FilterChoosingPapers')</button>
                </div>
            </div> --}}
        {{-- </form> --}}

        <br>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <h5><label for="tags">@lang('dashboard.SelectPapers')</label> </h5>
                    <h5 style="text-align:center">@lang('dashboard.TextSelectPapers')</h5>
                    @php $selected = $news->papers->pluck('id')->toArray() ?? []; @endphp
                    <select name="papers[]" class="tag-selector" id="news-data-papers" multiple="multiple" required>
                        @foreach ($approvedPapers as $key => $paper)
                            <option value="{{ $paper->id }}"
                                {{ in_array($paper->id, $selected) ? 'selected' : '' }}>
                                {{ $paper->titulo }}</option>
                        @endforeach
                    </select>
                    <a href={{ route('papers.create') }} class="btn btn-pramary">@lang('dashboard.WriteASummaryDashboard')</a>
                </div>
            </div>
        </div>        
    </form>

    <form method="POST" id="papers-filter" action="{{ route('papers.filter') }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {{--Papers filters--}}
        {{--<div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="hashtags">@lang('dashboard.FilterByTopics')</label>
                    <select name="tags[]" id="chart_tags" class="form-control tag-selector" multiple>
                        @foreach ($tag_helper->dropdown() as $tag)
                            @if ($tag->is_papers_tags && $tag->status == 1)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="link_investigacion">@lang('dashboard.CountryChoosingPapers')</label>
                    @include('auth.partials.country', ['value' => request()->query('country')])
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="link_investigacion">@lang('dashboard.AuthorChoosingPapers')</label>
                    <select name="user_id" class="form-control" id="user_id">
                        <option value="">@lang('dashboard.ChoosingAuthors')</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <button type="submit" class="btn btn-default">@lang('dashboard.FilterChoosingPapers')</button>
            </div>
        </div> --}}
    </form><br>

    <button class="btn btn-default" id="confirmBtn" style="float: right;">@lang('dashboard.ChooseTopic')</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('dashboard.CloseButton')</button>
</div>
