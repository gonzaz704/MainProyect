@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
            <h3>Title</h3>
            <p>{{$news->title}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
            <h3>Description</h3>
            <p>{{$news->content_without_html_tags}}</p>
            </div>
        </div>
        <form method="POST" action="{{action('NewsController@update', $news->id)}}" enctype="multipart/form-data">            
            <input type="hidden" name="_token" value="{{ csrf_token() }}">            
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        @php $selected = $news->tags->pluck('id')->toArray() ?? []; @endphp
                       <select name="tags[]" class="tag-selector" id="tags" multiple="multiple" required>
                        @foreach($tags as $key => $tag)
                            <option value="{{$key}}"
                            {{ in_array($key,$selected) ? 'selected' : '' }}
                            >{{ $tag }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
@endsection
