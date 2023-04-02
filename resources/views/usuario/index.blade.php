@extends('layouts.main')
@section('content')
    <div class="container bootstrap snippet">
        <div class="row">
            <div class="col-sm-3">
                <div class="avatar-container">
                    <img id="avatar-changer"
                        src="{{ $user->foto ? "images/$user->foto" : 'http://ssl.gstatic.com/accounts/ui/avatar_2x.png' }}"
                        class="rounded-circle img-thumbnail" alt="avatar">
                    <div class="overlay rounded-circle">
                        <button class="btn btn-default">Change</button>
                    </div>
                </div>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Points
                        <span class="badge badge-primary badge-pill">{{ $user->userrank->point }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Followers
                        <span class="badge badge-primary badge-pill">{{ $user->followers->count() }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Following
                        <span class="badge badge-primary badge-pill">{{ $user->following->count() }}</span>
                    </li>
                </ul>
                <div class="delete-container d-flex align-items-center justify-content-center" style="margin-top:10px">
                    <form method="POST" action="{{ route('usuario.destroy', ['id' => $user->id]) }}"  enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger">Delete Account</button>
                    </form>
                </div>
            </div>
            <div class="col-sm-9">
                <form method="POST" action="{{ route('usuario.update', ['id' => $user->id]) }}"
                    enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    {{ method_field('PUT') }}
                    <input type="file" name="foto" id="foto" accept="image/png, image/gif, image/jpeg" hidden>
                    <div class="form-group" style="margin-top:10px">
                        <label for="topic">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value={{ $user->name }}>
                    </div>
                    <div class="form-group" style="margin-top:10px">
                        <label for="topic">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value={{ $user->email }}
                            disabled>
                    </div>
                    <div class="form-group" style="margin-top:10px">
                        <label for="topic">Country</label>
                        @include('auth.partials.country',['value' => $user->country])
                    </div>
                    <div class="form-group">
                        <label for="topic">Nivel academico</label>
                        <select name="nivel_academico_id" class="tag-selector">
                            <option value="">Select your academic level</option>
                            @foreach ($academics as $academic)
                                <option value={{ $academic->id }}
                                    {{ $academic->id === $user->nivel_academico_id ? 'selected' : '' }}>
                                    {{ $academic->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="topic">Pais</label>
                        <select name="pais_id" class="tag-selector">
                            <option value="">Select</option>
                            @foreach ($pais as $p)
                                <option value={{ $p->id }} {{ $p->id === $user->pais_id ? 'selected' : '' }}>
                                    {{ $p->nacionalidad }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-default" style="margin-top:10px;">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
