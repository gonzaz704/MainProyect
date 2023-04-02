@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            @include('alerts.success')
            <form method="GET" action="{{ route('admin.news.index')  }}" accept-charset="UTF-8">
                <div id="custom-search-input">
                    <div class="input-group">
                        <input type="text" class="form-control" value=""
                               placeholder="Search a News" name="search"/>
                        <span class="input-group-btn">
                    <button class="btn btn-info btn-md" type="submit">
                        <i class="ficon ft-search"></i>
                    </button>
                </span>
                    </div>
                </div>
            </form>
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
                        <th>
                            <a class="btn btn-sm btn-danger" href="{{route('admin.news.delete-all')}}" type="submit">
                                 <i class="fa fa-trash">Delete all</i>
                            </a>
                        </th>
                    </tr>
                    </thead>
                    <tbody id="items">
                    @forelse($records as $record)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $record->country }}</td>
                            <td>{{ $record->source_name }}</td>
                            <td>{{ str_limit($record->title,'30','...') }}</td>
                            <td>{{ $record->status }}</td>
                            <td>{{ $record->date }}</td>
                            <td>{{  implode(',',$record->tags->pluck('name')->toArray()) }}</td>
                            <td>
                               <div class="d-inline-flex">
                                   <a href="{{ route('admin.news.show',[$record->id]) }}" class="btn btn-primary btn-sm mr-1">
                                       <i class="fa fa-eye"></i>
                                   </a>
                                   <form action="{{ route('admin.news.destroy',[$record->id]) }}" method="POST">
                                       {{ csrf_field() }}
                                       {{ method_field('delete') }}
                                       <button class="btn btn-sm btn-danger" href="" type="submit">
                                           <i class="fa fa-trash"></i>
                                       </button>
                                   </form>
                               </div>
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