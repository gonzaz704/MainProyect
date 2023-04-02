@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="col-sm-12">
            <div class="card" align="">
                <div class="card-block">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <img src="{{'/images/' . $user->foto }}" height="200px" width="170px">
                        </li>
                        <li class="list-group-item">Name : {{ $user->name }}</li>
                        <li class="list-group-item">Email : {{ $user->email }}</li>
                        <li class="list-group-item">Country : {{ $user->country }}</li>
                        <li class="list-group-item">Followings : {{ $user->following->count() }}</li>
                        <li class="list-group-item">Followers : {{ $user->followers->count() }}</li>
                        <li class="list-group-item">Papers : {{ $user->papers->count() }}</li>
                    </ul>

                </div>
            </div>
        </div>
    </div>

@endsection
