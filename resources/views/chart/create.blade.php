@extends('layouts.main')
@inject('tag_helper', 'App\Helpers\TagHelper')
@section('content')
    <div class="container">
        <legend>Upload your chart or table:</legend>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <form method="POST" action="{{ action('ChartController@store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group col-sm-12">
                    <label for="title">@lang('ChartsCreate.Title')</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                </div>
                <div class="form-group col-sm-12 d-none">
                    <label for="chartType">Upload charts or tables</label>
                    <select name="type" id="chartType" class="form-control">
                        {{-- <option selected value="">Choose Chart Type</option> --}}
                        <option value="1">Image</option>
                    </select>
                </div>
                <div class="form-group col-sm-12">
                    <label for="image">File Upload</label>
                    <input type="file" class="form-control-file" name="template" id="image">
                </div>

                <div class="form-group col-sm-12">
                    <label for="topic">@lang('ChartsCreate.Description')</label>
                    <input type="text" class="form-control" name="topic" value="{{ old('topic') }}" required>
                </div>

                <div class="form-group col-sm-12">
                    <label for="tags">@lang('ChartsCreate.Tags')</label>
                    <select name="tags[]" id="tags" class="form-control tag-selector" multiple>
                        @foreach ($tag_helper->dropdown() as $tag)
                            @if ($tag->is_charts_tags)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-12">
                    <label for="author">@lang('ChartsCreate.SourceName')</label>
                    <input type="text" class="form-control" name="author" value="{{ old('author') }}">
                </div>
                <div class="form-group col-sm-12">
                    <label for="author_email">@lang('ChartsCreate.SourceContact')</label>
                    <input type="text" class="form-control" name="author_email" value="{{ old('author_email') }}">
                </div>
                </fieldset>
                <div class="row mt-1">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
