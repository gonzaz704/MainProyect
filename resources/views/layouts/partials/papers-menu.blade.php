<div data-scroll-to-active="true" class="main-menu menu-fixed menu-light menu-accordion menu-shadow">
    <div class="main-menu-content">
        <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
            <li class=" navigation-header">
                <i data-toggle="tooltip" data-placement="right" data-original-title="MENU"  class=""></i>
            </li>
            <li class=" nav-item active">
                <a href="{{ route('data.index') }}">
                    <i class="ft-monitor"></i>
                    <span data-i18n="" class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class=" nav-item active">
                <a href="/">
                    <i class="ft-monitor"></i>
                    <span data-i18n="" class="menu-title">Notidata</span>
                </a>
            </li>

                <li>
                    <a href="{{ route('dashboard.search.papers') }}" class="menu-item">@lang('PapersDashboard.SearchPapers') </a>
                </li>

            @can('Search Open Data')
                <li>
                    <a href="{{ route('dashboard.search.open_data') }}" class="menu-item">@lang('PapersDashboard.SearchOpenData')</a>
                </li>
                <br>
            @endcan

                <li>
                    <a href="{{ action('PapersController@index') }}" class="menu-item">@lang('PapersDashboard.MyPapers')</a></li>
                <li>
                    <a href="{{ route('papers.create') }}" class="menu-item">@lang('PapersDashboard.WriteYourSummary')</a>
                </li>

                <li>
                    <a href="{{ route('create.chart') }}" class="menu-item">@lang('PapersDashboard.AddCharts/tables')</a>
                </li>
        {{--    <li>
                    <a href="{{ route('dashboard.showcharts.papers') }}" class="menu-item">@lang('Charts')</a>
                </li>
            @can('Confirm Paper')
                <li>
                    <a href="{{ route('papers.confirm.index') }}" class="menu-item">@lang('PapersDashboard.ConfirmPaperData')</a>
                </li>
            @endcan
            @can('Review Paper')
                <li>
                    <a href="{{ route('papers.reviews.index') }}" class="menu-item">@lang('PapersDashboard.ReviewPapers')</a>
                </li>
            @endcan
        --}}
            @can('Manage followers')
                <br>
                <li>
                    <a href="{{ action('FollowersController@index') }}" class="menu-item">@lang('PapersDashboard.Followers')</a>
                </li>
            @endcan
            @can('Manage following')
                <li>
                    <a href="{{ action('FollowingsController@index') }}" class="menu-item">@lang('PapersDashboard.Following')</a>
                </li>
            @endcan
            @can('Search Researchers')
                <li>
                    <a href="{{ action('InvestigadoresController@create') }}" class="menu-item">@lang('PapersDashboard.SearchAResearcher')</a>
                </li>
            @endcan
            <li>
                <a href="{{ route('ranking.index') }}" class="menu-item">@lang('PapersDashboard.Ranking')</a>
            </li>
            <li class=" nav-item">
                <a href="{{ route('contact') }}">
                    <i class="ft-mail"></i><span data-i18n="" class="menu-title">@lang('PapersDashboard.ContactUs')</span>
                </a>
            </li>
        </ul>
    </div>
</div>