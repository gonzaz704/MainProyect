@extends('layouts.main')

@section('content')
    <form method="POST" action="{{action("InvestigadoresController@save")}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
        <div class="form-group">
            <label for="nombre_investigadores">Agregar investigador</label>
            <input type="text" class="form-control" id="nombre_investigadores" name="nombre_investigadores">
        </div>

        <button type="submit" class="btn btn-default">Guardar</button>
    </form>
@endsection