@extends('layouts.papers')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            @include('alerts.success')
        </div>
        <div class="col-sm-12 mt-2">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Papers</th>
                        <th>News</th>
                        <th>Action</th>   
                    </tr>
                    </thead>
                    <tbody id="items">
                    @forelse($records as $record)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                           <td>{{ $record->paper->titulo }}</td>
                           <td>
                                <a href={{ route("news.details",$record->news->id) }}>{{ $record->news->title }}</a>
                           </td>
                           <td>
                                <a href="{{ route('papers.confirm',[$record->id]) }}" class="btn btn-primary btn-sm mr-1">
                                    <i class="fa fa-check"></i>
                                </a>
                           </td>
                        </tr>
                    @empty
                        <tr>
                            <td>No News Found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            {{ $records->links() }}
        </div>
    </div>

@endsection