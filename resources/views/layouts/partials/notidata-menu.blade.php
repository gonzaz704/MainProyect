<div data-scroll-to-active="true" class="main-menu menu-fixed menu-light menu-accordion menu-shadow">
    <div class="main-menu-content">
        <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
            <li class=" navigation-header">
                <i data-toggle="tooltip" data-placement="right" data-original-title="MENU" class=""></i>
            </li>

            <li class=" nav-item active">
                <a href="/">
                    <i class="ft-monitor"></i>
                    <span data-i18n="" class="menu-title">@lang('dashboard.Dashboard')</span>
                </a>
            </li>
            <li class=" nav-item">
                <a href="{{ route('data.index') }}">
                    <i class="ft-monitor"></i>
                    <span data-i18n="" class="menu-title">Papers</span>
                </a>
            </li>
            <li class=" nav-item ">
                <a href="{{ route('contact') }}">
                    <i class="ft-mail"></i>
                    <span data-i18n="" class="menu-title">@lang('dashboard.ContactusLeft')</span>
                </a>
            </li>
            <li class=" nav-item ">
                <a href="/policy">
                    <i class="ft-mail"></i>
                    <span data-i18n="" class="menu-title">@lang('dashboard.PolicyLeft')</span>
                </a>
            </li>
            @can('View Tools')
                {{-- <ul class="sub-menu">
                    <li>
                        <a href="{{action('KeyswordsController@keywordsfortext')}}">
                            <i class="fa fa-fw fa-rss"></i> Keywords
                        </a>
                    </li>

                </ul>

                <ul class="sub-menu">
                    <li>
                        <a href="{{action('AWSComprehendController@tosentimentAnalysis')}}">
                            <i class="fa fa-fw fa-rss"></i> AWS Comprehend
                        </a>
                    </li>

                </ul> --}}

                </li>
            @endcan
            @can('View Catalogs')
                <li class="menu-dropdown nav-item">
                    <a href="#">
                        <i class="menu-icon fa fa-list" aria-hidden="true"></i>
                        <span class="mm-text">Authors registration options</span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="{{ action('NivelAcademicoController@index') }}">
                                <i class="fa fa-fw fa-graduation-cap"></i> N. Académicos
                            </a>
                        </li>
                        <li>
                            <a href="{{ action('PaisController@index') }}">
                                <i class="fa fa-fw fa-globe"></i> Países
                            </a>
                        </li>
                        <li>
                            <a href="{{ action('InteresController@index') }}">
                                <i class="fa fa-fw fa-cubes"></i> Intereses
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('Manage Rss')
                <li>
                    <a href="{{ action('NewsController@index') }}">
                        <i class="fa fa-fw fa-rss"></i> Rss reader
                    </a>
                </li>
            @endcan
            @can('Manage Users')
                <li>
                    <a href="{{ route('admin.users.index') }}">
                        <i class="fa fa-fw fa-users"></i> Manage Users
                    </a>
                </li>
            @endcan
            @can('Manage News')
                <li>
                    <a href="{{ route('admin.news_sources.index') }}">
                        <i class="fa fa-fw fa-newspaper-o"></i> Manage News Sources
                    </a>
                </li>
            @endcan
            @can('Manage News')
                <li>
                    <a href="{{ route('admin.news.index') }}">
                        <i class="fa fa-fw fa-newspaper-o"></i> Manage News
                    </a>
                </li>
            @endcan

            @can('Manage My News')
                <li>
                    <a href="{{ route('my-news.index') }}">
                        <i class="fa fa-fw fa-newspaper-o"></i> My News
                    </a>
                </li>
            @endcan

            @can('Manage News Tags')
                <li>
                    <a href="{{ route('admin.newstags.index') }}">
                        <i class="fa fa-fw fa-newspaper-o"></i> Manage News Tags
                    </a>
                </li>
            @endcan
            @can('Manage Papers Tags')
                <li>
                    <a href="{{ route('admin.papers.index') }}">
                        <i class="fa fa-fw fa-newspaper-o"></i> Manage Papers
                    </a>
                </li>
            @endcan
            @can('Manage Papers Tags')
                <li>
                    <a href="{{ route('admin.paperstags.index') }}">
                        <i class="fa fa-fw fa-newspaper-o"></i> Manage Papers Tags
                    </a>
                </li>
            @endcan
            @can('Manage Charts Tags')
                <li>
                    <a href="{{ route('charts.index') }}">
                        <i class="fa fa-fw fa-newspaper-o"></i> Manage Charts
                    </a>
                </li>
            @endcan
            @can('Manage Charts Tags')
                <li>
                    <a href="{{ route('admin.chartstags.index') }}">
                        <i class="fa fa-fw fa-newspaper-o"></i> Manage Charts Tags
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</div>
