@extends('layouts.papers')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            @include('alerts.success')
        </div>
        <h4 align="center">You have to make sure each summary paper was made according to the <a href="{{ url('http://localhost/papers/create') }}">summary papers guide</a></h4> 
        <div class="col-sm-12 mt-2">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Papers</th>
                        <th>Action</th>   
                    </tr>
                    </thead>
                    <tbody id="items">
                    @forelse($records as $record)
                        @if($record->paper)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                            <td>
                                <a href={{ route("papers.details",$record->paper->id) }}>
                                    {{ $record->paper->titulo }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('papers.review',[$record->id]) }}" class="btn btn-primary btn-sm mr-1">
                                    <i class="fa fa-check"></i>
                                </a>
                            </td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td>Looks Clean</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            {{ $records->links() }}
        </div>
    </div>

@endsection