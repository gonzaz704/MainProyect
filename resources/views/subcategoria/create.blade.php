@extends('layouts.main')

@section('content')
    <form method="POST" action="save">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>

        <div class="form-group">
            <label for="categoria_id">Categoria:</label>
            <select name="categoria_id" id="categoria_id" class="form-control">
                <option value="">Seleccionar</option>
                @foreach($categorias as $categoria)
                    <option value="{{$categoria->id}}">{{$categoria->nombre_categoria}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="nombre_subcategoria">Sub Categoria:</label>
            <input type="text" class="form-control" id="nombre_subcategoria" name="nombre_subcategoria">
        </div>

        <button type="submit" class="btn btn-default">Enviar</button>
    </form>
@endsection
