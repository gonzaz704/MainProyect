@extends('layouts.main')

@section('content')
    <table class="table">
        <thead><th>Categoria</th><th>Acciones</th></thead>
        <tbody>
            @foreach($categorias as $categoria)
                <tr>
                    <td>{{$categoria->nombre_categoria}}</td>
                    <td>
                        <a href="{{ url('/categoria/' . $categoria->id . '/edit') }}"
                           class="btn btn-default">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </a>
                        <button class="btn btn-default">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    
@endsection