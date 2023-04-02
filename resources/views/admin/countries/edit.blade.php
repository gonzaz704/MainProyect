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
            <form method="POST" action="{{ route('admin.countries.update',['id' => $model->id]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group col-sm-12">
                    <label for="name">Name</label>
                    <input type="text" id="name" class="form-control" name="name" value="{{$model->name}}" required>
                </div>
                <div class="form-group col-sm-12">
                    <label for="code">Code</label>
                    <input type="text" id="code" class="form-control" name="code" value="{{$model->code}}" required>
                </div>
                <div class="row mt-1 ml-1">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>



           
@endsection

