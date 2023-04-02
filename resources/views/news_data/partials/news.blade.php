<div class="container mt-1"> <!-- Esta es la view de cuando clickeamos en ADD DATA y "NEWS" -->
    <div class="row">
        <div class="col-sm-12">
            <h5 style="text-align:center">@lang('dashboard.title-NewsTopic')</h5>
            <p>{{$news->title}}</p>
        </div>
    </div>
    <form method="POST" action="{{action('NewsController@update', $news->id)}}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
        @php $selected = $news->tags->pluck('id')->toArray() ?? []; @endphp
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <h5><label for="tags_{{$news->id}}">@lang('dashboard.NewsTopic')</label> </h5>
                    <select data-url={{ route('filter.tags')}} name="tags[]" class="tag-selector" id="tags_{{$news->id}}" multiple="multiple" required>  Aca entra el input unico de "News topic".. Cambiarlo por cada opcion de TOPIC 
                        @foreach($tags as $key => $tag)
                            @if($tag->is_news_tags)
                            <option value="{{$tag->id}}"
                            {{ in_array($key,$selected) ? 'selected' : '' }}
                            >{{ $tag->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <p class="tag-helper"></p>
                </div>
            </div>
        </div> 
        <button type="submit" class="btn btn-default">@lang('dashboard.ChooseTopic')</button>
    </form>
</div>







