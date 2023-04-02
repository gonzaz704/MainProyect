@extends('layouts.papers')
@inject('paper_helper','App\Helpers\PaperHelper')
@php $users = $paper_helper->getUsers() @endphp
@section('content')
    <div class="row">
        <form>
            {{-- <div class="form-group col-sm-4">
                <label for="country">Country</label>
                @include('auth.partials.country',['value' => request()->query('country')])
            </div> --}}
            <div class="form-group col-sm-4">
                <label for="topic">Topic</label>
                <input type="text" name="topic" id="topic" class="form-control" value="{{ request()->query('topic') }}">
            </div>
            {{-- <div class="form-group col-sm-4">
                <label for="topic">Authors</label>
                <select name="user_id" class="form-control" id="topic" value="{{ request()->query('user_id') }}">
                    <option value="">Choose Authors</option>
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{ $user->name ?? '' }}</option>
                    @endforeach
                </select>
            </div> --}}
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </form>
    </div>
    <div class="row mt-2">
        @forelse($papers->groupBy('creado_por_id') as $user_id => $groups)
            @php $user = $paper_helper->getUserById($user_id) @endphp
            @foreach($groups as $paper)
                <div class="col-sm-12">
                    <div class="card item">
                        <h5 class="card-header card-title">{{ $paper->titulo }}</h5>
                        <div class="paper-slider owl-carousel owl-theme">
                            <div class="item card-block">
                                <p class="card-title">{!! $paper->abstract !!}</p>
                            </div>
                            @if(is_array($paper->ruta_grafico))
                                @foreach($paper->ruta_grafico as $image)
                                    <div class="item">
                                        <img class="card-img-top img-responsive" src="{{ '/images/' . $image }}"
                                             alt="Card image cap">
                                    </div>
                                @endforeach
                            @else
                                @if($paper->ruta_grafico)
                                    <div class="item">
                                        <img class="card-img-top img-responsive" src="{{ '/images/' .$paper->ruta_grafico }}"
                                             alt="Card image cap">
                                    </div>
                                @endif
                            @endif
                        </div>
                        {{-- <ul class="list-group list-group-flush">
                            <li class="list-group-item">Conclusion 1 : {{$paper->conclusiones_1}}</li>
                            <li class="list-group-item">Conclusion 2 : {{$paper->conclusiones_2}}</li>
                            <li class="list-group-item">Conclusion 3 : {{$paper->conclusiones_3}}</li>
                        </ul> --}}
                        <div class="card-block">
                            <p class="card-title">Author : {{ $user->name ?? '' }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
            @empty
                <h4>No papers found.</h4>
            @endforelse
    </div>
@endsection
