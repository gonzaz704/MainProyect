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
        <h3>Add Country</h3>
        <div class="row">
            <form method="POST" action="{{ route('admin.topics.update',['id' => $model->id]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
            {{ method_field('PUT') }}
                <div class="form-group col-sm-12">
                    <label for="country_id">Country</label>
                    <select id="country_id" class="form-control" name="country_id"  required>
                        <option value="">Select a country</option>
                        @foreach($countries as $value => $name)
                            <option {{ $value === $model->country_id ? 'selected': null}} value="{{ $value}}">{{ $name}}</option>
                        @endforeach
                    </select>
                </div>
                 <div class="form-group col-sm-12">
                    <label for="parent_id">Parent</label>
                    <select id="parent_id" class="form-control" name="parent_id">
                        <option value="">Select a parent</option>
                        @foreach($topics as $value => $name)
                            <option {{ $value === $model->parent_id ? 'selected': null}} value="{{ $value}}">{{ $name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-12">
                    <label for="name">Name</label>
                    <input type="text" id="name" data-slug="slug" class="form-control" name="name" value="{{$model->name}}" required>
                </div>
                <div class="form-group col-sm-12">
                    <label for="slug">Slug</label>
                    <input type="text" id="slug" class="form-control" name="slug" value="{{$model->slug}}" required>
                </div>
                <div class="row mt-1 ml-1">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>



           
@endsection

