@extends('layouts.main')
@inject('paper_helper','App\Helpers\PaperHelper')
@php $papers = $paper_helper->getPapers(request()->get('paper')) @endphp
@section('content')

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ request()->query('paper') ? '' : 'active' }}" data-toggle="tab" role="tab" href="#news">News</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" role="tab" href="#charts">Charts</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->query('paper') ? 'active' : '' }}" data-toggle="tab" role="tab" href="#papers">Papers</a>
        </li>
    </ul>

    <div class="tab-content mt-1">
        @include('news.partials.news')
        @include('news.partials.charts')
        @include('news.partials.papers')
    </div>

@endsection
