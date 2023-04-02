@extends('layouts.main')

@section('content')

<form method="POST" action="{{action("DashboardController@save")}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
        <div class="form-group">
            <label for="titulo">titulo:</label>
            <input type="text" class="form-control" id="titulo" name="titulo">
        </div>

        <button type="submit" class="btn btn-default">Guardar</button>
    </form>









@endsection