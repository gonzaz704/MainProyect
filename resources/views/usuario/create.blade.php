@extends('layouts.main')

@section('content')

    <link rel="stylesheet" type="text/css" href="{{asset('/css/smart_wizard/smart_wizard_extend.css')}}">


    <div id="smartwizard">
        <ul>
            <li><a href="#step1">Paso 1<br /><small>Información personal</small></a></li>
            <li><a href="#step2">Paso 2<br /><small>Intereses</small></a></li>
            <li><a href="#step3">Paso 3<br /><small>Usuarios a seguir</small></a></li>
            <li><a href="#step4">Paso 4<br /><small>Finsh Up</small></a></li>
        </ul>

        <div>
            <div id="step1" class="">

                <form id="frm_personal" method="POST" action="{{action("UserController@updateprofile")}}" enctype="multipart/form-data">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label for="titulo">foto</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                    </div>
                    @if(auth()->user()->type === 'Researcher')
                    <div class="form-group">
                        <label for="titulo">Nivel Académico</label>
                        
                        <select name="nacademy" id="nacademy" class="form-control">

                            @if($user->nivel_academico_id)

                                <option value="">-- Seleccione --</option>

                            @else

                                <option value="" selected="true">-- Seleccione --</option>

                            @endif


                            @foreach($nacademy as $item)
                            
                                @if($user->nivel_academico_id == $item->id)
                                    <option value="{{$item->id}}" selected="true">{{$item->nombre}}</option>
                                @else
                                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                                @endif

                            @endforeach


                        </select>
                    </div>
                    @endif
                    
                    
                    <div class="form-group">
                        <label for="titulo">País</label>
                        <select name="pais" id="pais" class="form-control">

                            @if($user->pais_id)

                                <option value="">-- Seleccione --</option>

                            @else

                                <option value="" selected="true">-- Seleccione --</option>

                            @endif


                            @foreach($pais as $item)
                            
                                @if($user->pais_id == $item->id)
                                    <option value="{{$item->id}}" selected="true">{{$item->nombre}}</option>
                                @else
                                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                                @endif

                            @endforeach


                        </select>
                    </div>
                    
                </form>

            </div>


            <div id="step2" class="">

                <form id="frm_intereses" method="POST" action="{{action("UserController@set_intereses")}}" enctype="multipart/form-data">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label for="titulo">Intereses</label>
                    </div>

                    <div class="row">
                    @foreach($intereses as $interes)

                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        @php
                                            $found=false
                                        @endphp
                                        @foreach( $user->intereses as $myinteres)
                                            @if( $myinteres->id == $interes->id   )
                                                @php
                                                    $found = true
                                                @endphp
                                            @endif
                                        @endforeach
                                        @if( $found )
                                            <input type="checkbox" checked="true" id="interes[]" name="interes[]" value="{{ $interes->id }}">
                                        @else
                                            <input type="checkbox" id="interes[]" name="interes[]" value="{{ $interes->id }}">
                                        @endif
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        {{ $interes->nombre }}
                                    </label>
                                </div>
                            </div>
                        </div>

                     @endforeach

                     </div>

                </form>

            </div>

            <div id="step3" class="">

                <form id="frm_followings" method="POST" action="{{ route('usario.follow') }}" enctype="multipart/form-data">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label for="titulo">Usuarios para seguir</label>
                    </div>

                    <div class="row" data-url={{action("UserController@get_followings_interests")}} id="body_followings">


                    </div>

                </form>

            </div>
            <div id="step4">
                <div class="col-sm-12">
                    <div class="card" align="center">
                        <div class="card-block">
                            <a href="/">Go to Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


     <script type="text/javascript">

        var callback = function(){

            var route_images = "{{ URL::to('/images/') }}";
            var route_profile = "{{ route('user.profile', [ 'id' => 'nump'] ) }}";

            profilew = new ProfileWizard();
            profilew.set_route_img(route_images);
            profilew.set_route_profile(route_profile);
            profilew.start();

        };

        if (
            document.readyState === "complete" ||
            (document.readyState !== "loading" && !document.documentElement.doScroll)
        ) {
            callback();
        } else {
            document.addEventListener("DOMContentLoaded", callback);
        }



    </script>



    



@endsection



