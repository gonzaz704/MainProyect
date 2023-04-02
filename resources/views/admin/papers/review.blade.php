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
        <h3>Review</h3>
        <div class="row">
            <div class="row mt-2">
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
                                        <img class="card-img-top img-responsive"
                                             src="{{ '/images/' .$paper->ruta_grafico }}"
                                             alt="Card image cap">
                                    </div>
                                @endif
                            @endif
                        </div>
                        {{-- <ul class="list-group list-group-flush">
                            <li class="list-group-item">Conclusion 1 : {{$paper->conclusiones_1}}</li>
                            <li class="list-group-item">Conclusion 2 : {{$paper->conclusiones_2}}</li>
                            <li class="list-group-item">Conclusion 3 : {{$paper->conclusiones_3}}</li>
                        </ul>  --}}
                        <div class="card-block">
                            <p class="card-title">Author : {{ $paper->author_name ?? '' }}</p>
                        </div>

                        @foreach($paperfeedback as $row)
                            @if($row->description)
                                <div class="card-block" style="padding-bottom: 0">
                                    <div class="form-control">
                                        <p>{{$row->description}}</p>
                                        @php $user = $userHelper->getUser($row->user_id);
                                        if ($user->id == 1){
                                            $name = 'admin';
                                        }elseif($user->id == \Illuminate\Support\Facades\Auth::user()->id){
                                            $name = 'auther';
                                        }else{
                                            $name = $user->name;
                                        }
                                        @endphp
                                        <label>By: {{$name}}</label>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <form action="{{route('papers.review.update',$paper->id)}}" method="POST">
                            {{ csrf_field() }}
                            <div class="card-block">
                                <textarea class="form-control"
                                          name="feedback"></textarea>
                            </div>
                            <div class="row mt-1 ml-1">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
