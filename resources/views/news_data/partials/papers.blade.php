@inject('paper_helper','App\Helpers\PaperHelper')
@inject('tag_helper','App\Helpers\TagHelper')
@php $users = $paper_helper->getUsers() @endphp
<div class="container mt-1">
    <h3 style="text-align:center">@lang('dashboard.SelectPapers')</h3>
     <h5 style="text-align:center">@lang('dashboard.TextSelectPapers')</h5>
    <form method="POST" action="{{ route('news.papers', $news->id) }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @php $selected = $news->papers->pluck('id')->toArray() ?? []; @endphp
        <div class="row">
            <div class="form-group" style="margin-top:10px">
                <div class="col-sm-12">
                    <select name="papers[]" class="tag-selector" id="news-data-papers" multiple="multiple" required>
                        @foreach ($approvedPapers as $key => $paper)
                            <option value="{{ $paper->id }}" {{ in_array($paper->id , $selected) ? 'selected' : '' }}>
                                {{ $paper->author_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-default">@lang('dashboard.ConfirmPaperDashboard')</button>
        <a href={{ route('papers.create') }} class="btn btn-pramary">@lang('dashboard.WriteASummaryDashboard')</a>
    </form>
    </br></br>
        <form method="POST" id="papers-filter" action="{{ route('papers.filter') }}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="hashtags">@lang('dashboard.FilterByTopics')</label>
                    <select name="tags[]" id="tags" class="form-control tag-selector" multiple>
                            @foreach($tag_helper->dropdown() as $tag)
                            @if($tag->is_papers_tags)
                                <option value="{{ $tag->id}}">{{ $tag->name}}</option>
                            @endif
                            @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="link_investigacion">@lang('dashboard.CountryChoosingPapers')</label>
                    @include('auth.partials.country',['value' => request()->query('country')])
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="link_investigacion">@lang('dashboard.AuthorChoosingPapers')</label>
                    <select name="user_id" class="form-control" id="user_id" value=""> </br>
                        <option value="">@lang('dashboard.ChoosingAuthors')}}</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            </div>
            <div class="row">
            <div class="col-sm-4">
                <button type="submit" class="btn btn-default">@lang('dashboard.FilterChoosingPapers')</button>
            </div>
            </div>
        </form>
</div>
