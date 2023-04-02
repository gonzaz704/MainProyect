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
            <form method="POST" action="{{ url('admin.papers.update', ['id' => $record->id]) }}"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group col-sm-12">
                    <label for="titulo">Title</label>
                    <input type="titulo" id="titulo" class="form-control" name="titulo"
                        value="{{ $record->titulo }}" required>
                </div>
                <div class="form-group col-sm-12">
                    <label for="author_name">Author Name</label>
                    <input type="text" id="author_name" class="form-control" name="author_name" value="{{ $record->author_name }}"
                        required>
                </div>
                <div class="form-group col-sm-12">
                    <label for="author">Author Email</label>
                    <input type="text" id="author" class="form-control" name="author" value="{{ $record->author }}"
                        required>
                </div>
                <div class="form-group col-sm-12">
                    <label for="tags">Tags</label>
                        <select name="tags[]" class="tag-selector" id="news-data-papers" multiple="multiple" required>
                            @foreach ($tags as $key => $tag)
                                <option value="{{ $key }}" {{ in_array($key, $record->tags) ? 'selected' : '' }}>
                                    {{ $tag->name }}</option>
                            @endforeach
                        </select>
                </div>
                <div class="form-group col-sm-12">
                    <label for="tutors">Tutors</label>
                    <input type="text" id="tutors" class="form-control" name="tutors" value="{{ $record->tutors }}"
                        required>
                </div>
                <div class="form-group col-sm-12">
                    <label for="abstract">Abstract</label>
                    <textarea id="abstract" class="form-control" name="abstract">{{ $record->abstract }}</textarea>
                </div>
                <div class="form-group col-sm-12">
                    <label for="conclusiones_1">conclusiones_1</label>
                    <textarea id="conclusiones_1" class="form-control" name="conclusiones_1">{{ $record->conclusiones_1 }}</textarea>
                </div>
                <div class="form-group col-sm-12">
                    <label for="conclusiones_2">conclusiones_2</label>
                    <textarea id="conclusiones_2" class="form-control" name="conclusiones_2">{{ $record->conclusiones_2 }}</textarea>
                </div>
                <div class="form-group col-sm-12">
                    <label for="conclusiones_3">conclusiones_3</label>
                    <textarea id="conclusiones_3" class="form-control" name="conclusiones_3">{{ $record->conclusiones_3 }}</textarea>
                </div>
                <div class="form-group col-sm-12">
                    <label for="conclusiones_4">conclusiones_4</label>
                    <textarea id="conclusiones_4" class="form-control" name="conclusiones_4">{{ $record->conclusiones_4 }}</textarea>
                </div>
                <div class="form-group col-sm-12">
                    <label for="conclusiones_5">conclusiones_5</label>
                    <textarea id="conclusiones_5" class="form-control" name="conclusiones_5">{{ $record->conclusiones_5 }}</textarea>
                </div>
                <div class="form-group col-sm-12">
                    <label for="conclusiones_6">conclusiones_6</label>
                    <textarea id="conclusiones_6" class="form-control" name="conclusiones_6">{{ $record->conclusiones_6 }}</textarea>
                </div>
                <div class="form-group col-sm-12">
                    <label for="conclusiones_7">conclusiones_7</label>
                    <textarea id="conclusiones_7" class="form-control" name="conclusiones_7">{{ $record->conclusiones_7 }}</textarea>
                </div>
                <div class="form-group col-sm-12">
                    <label for="conclusiones_8">conclusiones_8</label>
                    <textarea id="conclusiones_8" class="form-control" name="conclusiones_8">{{ $record->conclusiones_8 }}</textarea>
                </div>
                <div class="form-group col-sm-12">
                    <label for="ruta_grafico">ruta_grafico</label>
                    <input type="file" id="ruta_grafico" class="form-control" name="ruta_grafico[]">
                    
                    @foreach ($record->ruta_grafico as $ruta_grafico)
                        <img src="{{asset($ruta_grafico)}}" width="40">
                    @endforeach         
                </div>
                <div class="form-group col-sm-12">
                    <label for="link_investigacion">Link Investigacion</label>
                    <textarea id="link_investigacion" class="form-control" name="link_investigacion">{{ $record->link_investigacion }}</textarea>
                </div>
                <div class="form-group col-sm-12">
                    <label for="hashtags">Hashtags</label>
                    <textarea id="hashtags" class="form-control" name="hashtags">{{ $record->hashtags }}</textarea>
                </div>
                <div class="form-group col-sm-12">
                    <label for="topic">Topic</label>
                    <input type="text" id="topic" class="form-control" name="topic" value="{{ $record->topic }}"
                        required>
                </div>
                <div class="row mt-1 ml-1">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
