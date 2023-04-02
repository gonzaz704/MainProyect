@extends('layouts.main')
@inject('tag_helper','App\Helpers\TagHelper')
@php $selected_tags = $chart->tags->pluck('id')->toArray() @endphp
@section('content')
    <div class="container">
        <h3>Edit Chart</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ action('ChartController@update', $chart->id) }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group col-sm-12">
                <label for="title">Title</label>
                <input type="text" id="title" class="form-control" name="title" value="{{ $chart->title }}">
            </div>
            <div class="d-none">
                <div class="form-group col-sm-12">
                    <label for="chartType">Chart Type</label>
                    <select name="type" id="chartType" class="form-control">
                        <option selected>Choose Chart Type</option>
                        <option value="0" {{ $chart->type == 0 ? 'selected' : '' }}>Charts</option>
                        <option value="1" {{ $chart->type == 1 ? 'selected' : '' }}>Image</option>
                    </select>
                </div>
            </div>
            @if ($chart->type == 1 && $chart->template != '')
                <div><img src="{{ storage_path('app/' . $chart->template) }}" alt=""></div>
            @endif
            <div class="hidden image-selector">
                <div class="form-group col-sm-12">
                    <label for="image">File Upload</label>
                    <input type="file" class="form-control-file" name="template" id="image">
                </div>
            </div>
             <div class="form-group col-sm-12">
                <label for="tags">@lang('ChartsCreate.Tags')</label>
                <select name="tags[]" id="tags" class="form-control tag-selector" multiple>
                    @foreach($tag_helper->dropdown() as $tag)
                    @if($tag->is_charts_tags)
                        <option {{ in_array($tag->id,$selected_tags) ? 'selected' : null}} value="{{ $tag->id}}">{{ $tag->name}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
                <div class="form-group col-sm-12">
                    <label for="topic">Description</label>
                    <input type="text" id="topic" class="form-control" name="topic" value="{{ $chart->topic }}">
                </div>
            <div class="hidden chart-selector">
                <div class="form-group col-sm-12">
                    <label for="template">Select Chart</label>
                    <select name="template" id="template" class="form-control">
                            <option value="">Select Template</option>
                        @foreach (getAllFiles(resource_path('views/data/charts')) as $filename)
                            <option {{ $chart->type == $filename ? 'selected' : '' }} value="{{ $filename }}">{{ $filename }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group col-sm-12">
                <label for="author">@lang('ChartsCreate.SourceName')</label>
                <input type="text" class="form-control" name="author" value="{{$chart->author }}">
            </div>

            <div class="form-group col-sm-12">
                <label for="author_email">@lang('ChartsCreate.SourceContact')</label>
                <input type="text" class="form-control" name="author_email" value="{{$chart->author_email }}">
            </div>           
            <div class="row mt-1">
               <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
               </div>
            </div>
        </form>
    </div>
@endsection
