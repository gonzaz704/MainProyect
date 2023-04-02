<nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-semi-light bg-gradient-x-grey-blue">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav">
                <li class="nav-item mobile-menu hidden-md-up float-xs-left">
                    <a href="#" class="nav-link nav-menu-main menu-toggle hidden-xs">
                        <i class="ft-menu font-large-1"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/" class="navbar-brand">
                        <img alt="stack admin logo" src="{{URL::to('/images/logo/stack-logo.png')}}" class="brand-logo">
                        <!-- <div class="brand-text">Notidata</div> -->
                        <div class="brand-text">{{ Session::get('mode') }}</div>
                    </a>
                </li>
                <li class="nav-item hidden-md-up float-xs-right">
                    <a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container">
                        <i class="fa fa-ellipsis-v"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="navbar-container content container-fluid">
            <div id="navbar-mobile" class="collapse navbar-toggleable-sm">  
                <ul class="nav navbar-nav col-xs-12 col-sm-12 col-md-1 col-lg-1">
                    <li class="nav-item hidden-sm-down">
                        <a href="#" class="nav-link nav-menu-main menu-toggle hidden-xs">
                            <i class="ft-menu"></i>
                        </a>
                    </li>
                </ul>            
                <ul class="nav navbar-nav nav-search col-xs-12 col-sm-12 col-md-5 col-lg-6">
                    @include('layouts.partials.navbar-search') 
                </ul> 
                  
                @auth
                    <ul class="nav navbar-nav right-menu col-xs-12 col-sm-12 col-md-6 col-lg-5">
                        <li class="nav-item nav-link">
                            @if(Session::get('mode') == "notidata")                                
                                <a button class="btn btn-primary " type="submit" href="{{ route('data.index') }}">
                                    Papers
                                </a>
                            @else
                                <a button class="btn btn-primary" type="submit" href="/">Notidata</a>
                            @endif
                        </li>
                        <li class="dropdown nav-item notification_dropdown_read">
                            <a href="#" data-toggle="dropdown" class="nav-link nav-link-label" aria-expanded="false"><i
                                    class="ficon ft-bell"></i>
                                <span class="tag tag-pill tag-default tag-danger tag-default tag-up">
                                    {{ auth()->user()->unreadnotifications->count() }}
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <h6 class="dropdown-header m-0">
                                        <span class="grey darken-2">Notifications</span>
                                        <span class="notification-tag tag tag-default tag-danger float-xs-right m-0">
                                            {{ auth()->user()->unreadnotifications->count() }}
                                            New
                                        </span>
                                    </h6>
                                </li>
                                <li class="list-group scrollable-container ps-container ps-theme-dark ps-active-y"
                                    data-ps-id="82a7d3a9-7b94-a4ad-9683-ea2c70811727">
                                    <p><a class="allread-mark" href="{{ route('markRead.notification') }}">
                                        Mark all as Read</a>
                                    </p>
                                    @forelse(auth()->user()->notifications as $notification)
                                        <div class="list-group-item">
                                            <div class="media">
                                                <div class="media-left valign-middle"><i
                                                        class="ft-plus-square icon-bg-circle bg-cyan"></i>
                                                </div>
                                                <div class="media-body">
                                                <a href={{ route('notification',['id' => $notification->id]) }} {{ $notification->read_at ? 'style=color:#333;' : '' }}>{{ $notification->data['message'] }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="list-group-item">
                                            <div class="media">
                                                <div class="media-left valign-middle"><i
                                                        class="ft-plus-square icon-bg-circle bg-cyan"></i>
                                                </div>
                                                <div class="media-body">
                                                    <a herf="#">No Notifications</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforelse
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Config::get('languages')[App::getLocale()] }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            @foreach (Config::get('languages') as $lang => $language)
                                @if ($lang != App::getLocale())
                                        <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}"> {{$language}}</a>
                                @endif
                            @endforeach
                            </div>  
                        </li>
                        <li class="dropdown nav-item">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link">
                                <span class="avatar avatar-online">
                                    <img src="{{ Auth::user()->avatar() }}"
                                        alt="avatar"><i></i></span>
                                <span class="user-name">{{ Auth::user()->name }} ({{ Auth::user()->rank }})</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a
                                    href="{{ action('UserController@index') }}" class="dropdown-item">
                                    <i class="ft-user"></i>
                                    @lang('dashboard.MyProfile')
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="" class="dropdown-item"><i class="ft-aperture"></i>
                                @lang('dashboard.MyPreferences')
                                </a>
                                
                                <div class="dropdown-divider"></div>
                                    <a href="@" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="ft-power"></i>
                                        @lang('dashboard.Logout')
                                    </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    </ul>
                @else
                    <ul class="nav navbar-nav right-menu col-xs-12 col-sm-12 col-md-6 col-lg-5">
                        <li class="nav-item nav-link">
                            @if(Session::get('mode') == "notidata")
                                <a button class="btn btn-primary" type="submit" href="{{ route('data.index') }}">
                                    Papers
                                </a>
                            @else
                                <a button class="btn btn-primary" type="submit" href="/">Notidata</a>
                            @endif
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Config::get('languages')[App::getLocale()] }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            @foreach (Config::get('languages') as $lang => $language)
                                @if ($lang != App::getLocale())
                                        <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}"> {{$language}}</a>
                                @endif
                            @endforeach
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                @lang('dashboard.Login')
                            </a> 
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                @lang('dashboard.Register')
                            </a> 
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact') }}">
                                @lang('dashboard.Contactus')
                            </a> 
                        </li>
                    </ul>
                @endauth
            </div>
        </div>
    </div>
</nav>

