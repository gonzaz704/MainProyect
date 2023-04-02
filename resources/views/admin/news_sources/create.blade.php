@extends('layouts.main')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h3>Add Tag</h3>
        <div class="row">
            <form method="POST" action="{{ route('admin.news_sources.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group col-sm-12">
                    <label for="name">Title</label>
                    <input type="text" id="title" data-slug="slug" class="form-control" name="title" value="{{old('title')}}" required>
                </div>
                <div class="form-group col-sm-12">
                    <label for="slug">Slug</label>
                    <input type="text" id="slug" class="form-control" name="slug" value="{{old('slug')}}" required>
                </div>
                <div class="form-group col-sm-12">
                    <label for="name">Url</label>
                    <input type="text" id="url" class="form-control" name="url" value="{{old('url')}}" required>
                </div>
                <div class="form-group col-sm-12">
                    <label for="name">Country</label>
                    <input type="text" id="country" class="form-control" name="country" value="{{old('country')}}" required>
                </div>
                <div class="form-group col-sm-12">
                    <label for="name">TimeZone</label>
                    <input type="text" id="timezone" class="form-control" name="timezone" value="{{old('timezone')}}" required>
                </div>
                <div class="form-group col-sm-12">
                    <label for="name">Image Element</label>
                    <input type="text" id="image_element" class="form-control" name="image_element" value="{{old('image_element')}}" >
                </div>
                <div class="form-group col-sm-12">
                    <label for="name">Image Attribute</label>
                    <input type="text" id="image_attr" class="form-control" name="image_attr" value="{{old('image_attr')}}" >
                </div>
                <div class="form-group col-sm-12">
                    <label for="name">Image Base Url</label>
                    <input type="text" id="image_base_url" class="form-control" name="image_base_url" value="{{old('image_base_url')}}" >
                </div>
                <div class="row mt-1 ml-1">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

