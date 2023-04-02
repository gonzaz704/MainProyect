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
        <h3>Edit Tag</h3>
        <div class="row">
            <form method="POST" action="{{ route('admin.newstags.update',['id' => $model->id]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group col-sm-12">
                    <label for="name">Name</label>
                    <input type="text" id="name" class="form-control" data-slug="slug" name="name" value="{{$model->name}}" required>
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

