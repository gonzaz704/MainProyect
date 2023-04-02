@extends('layouts.main')

@section('content')
   
        <form method="POST" action="{{action("CategoriaController@edit")}}" enctype="multipart/form-data">

        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
        <input type="hidden" name="id" value="{{ $categoria->id }}">
        <div class="form-group">
            <label for="nombre_categoria">Categoria:</label>
            <input type="text" class="form-control" id="nombre_categoria"
                   name="nombre_categoria" value="{{ $categoria->nombre_categoria }}">
        </div>

        <button type="submit" class="btn btn-default">Enviar</button>
    </form>
@endsection
