@extends('layouts.main')

@section('content')



    <div class="container-fluid">
        <div class="col-sm-12">

            <div class="card" align="center">
                <div class="card-block">
                    <h3 class="card-subtitle">{{$user->name}}</h3>
                    <img src="{{'/images/' . $user->foto }}" height="200px" width="170px">
                    <br>
                </div>
            </div>


        </div>
        <div class="col-sm-12">
            <div class="card" align="center">
                <div class="card-block">
                    @if(Auth::user()->following->count())
                        @if(App\Following::findfollowing($user->id))
                            <a href="#" class="btn btn-primary">Following</a>
                        @else
                            <a href="{{route('profile.follow',['id'=>$user->id])}}"
                               class="btn btn-primary">Follow</a>
                            {{--<a data-userid="{{$user->id}}" href="#" id="user-follow" class="btn btn-primary">Follow</a>--}}
                        @endif
                    @else
                        <a href="{{route('profile.follow',['id'=>$user->id])}}"
                           class="btn btn-primary">Follow</a>
                        {{--<a data-userid="{{$user->id}}" href="#" id="user-follow" class="btn btn-primary">Follow</a>--}}
                    @endif
                </div>
            </div>
        </div>


    </div>


@endsection

