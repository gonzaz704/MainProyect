@extends('layouts.main')
@section('content')
    <div class="col-sm-12">
        <div class="card item">
            <h5 class="card-header card-title">
                <a href="{{ $paper->link_investigacion }}" target="_blank">{{ $paper->titulo }}</a>
            </h5>
            <div class="paper-slider owl-carousel owl-theme">
                <div id="expandable-container-paper" class="expandable-container item card-block">
                    <span class="item pappers-list__body" aria-expanded="false">
                        {!! $paper->abstract !!}                               
                    </span>
                    @if(strlen($paper->abstract) > 400)
                        <a role="button" class="expandable-container__show-more content-collapsed"
                           href="#expandable-container-paper"></a>
                    @endif
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
            <ul class="list-group list-group-flush">
                @foreach(range(1,9) as $value)
                    @php
                        $fieldname = 'conclusiones_' . $value;
                    @endphp
                    @if($paper->$fieldname != "")
                        <li id="expandable-container-paper-conclusion{{$value}}" class="list-group-item">
                            <h5>Conclusion {{ $value }} :</h5>
                            <div class="expandable-container">
                                <span class="item pappers-list__body" aria-expanded="false">                                        
                                    {{ $paper->$fieldname }}
                                </span>
                                @if(strlen($paper->$fieldname) > 400)
                                    <a role="button" class="expandable-container__show-more content-collapsed"
                                       href="#expandable-container-paper-conclusion{{$value}}"></a>
                                @endif
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
            <div class="card-block">
                <p class="card-title">Author : {{ $paper->createdBy->name }}</p>
            </div>

            @if($paper->creado_por_id == \Illuminate\Support\Facades\Auth::user()->id)
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
            @endif
        </div>
    </div>
@endsection
