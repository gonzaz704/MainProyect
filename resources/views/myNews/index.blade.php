@extends('layouts.main')

@section('content')
    @include('alerts.success')

    <div class="row">
        <div class="col-sm-8">
            <form method="GET" action="{{ route('my-news.index') }}" accept-charset="UTF-8">
                <div id="custom-search-input">
                    <div class="input-group">
                        <input type="text" class="form-control" value="" placeholder="Search a News" name="search" />
                        <span class="input-group-btn">
                            <button class="btn btn-info btn-md" type="submit">
                                <i class="ficon ft-search"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-4">
            <a href="{{ route('my-news.create') }}" class="btn btn-primary">Add News</a>
        </div>
        <div class="col-sm-12 mt-2">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Country</th>
                            <th>Source</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Tags</th>
                            <th>Action</th>
                            {{-- <th>
                                <a class="btn btn-sm btn-danger" href="#" type="submit">
                                    {{ route('my-news.delete-all') }}
                                    <i class="fa fa-trash">Delete all</i>
                                </a>
                            </th> --}}
                        </tr>
                    </thead>
                    <tbody id="items">
                        @forelse($news as $record)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $record->country }}</td>
                                <td>{{ $record->news_source ? $record->news_source->title : 'N/A' }}</td>
                                <td>{{ str_limit($record->title, '30', '...') }}</td>
                                <td>{{ $record->status }}</td>
                                <td>{{ $record->date }}</td>
                                <td>{{ implode(',', $record->tags->pluck('name')->toArray()) }}</td>
                                <td>
                                    <div class="d-inline-flex">
                                        <a href="{{ route('my-news.show', [$record->id]) }}"
                                            class="btn btn-primary btn-sm mr-1">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        @if ($record->status == 'draft')
                                            <a href="{{ route('my-news.edit', [$record->id]) }}"
                                                class="btn btn-info btn-sm mr-1">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            <form action="{{ route('my-news.destroy', [$record->id]) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button class="btn btn-sm btn-danger" href="" type="submit">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('my-news.destroy', [$record->id]) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button class="btn btn-sm btn-danger" href="" type="submit">
                                                    <i class="fa fa-refresh"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">No News Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $news->links() }}
        </div>
    </div>
@endsection
