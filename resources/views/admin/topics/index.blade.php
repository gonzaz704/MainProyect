@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            @include('alerts.success')
            <form method="GET" action="{{ route('admin.topics.index')  }}" accept-charset="UTF-8">
                <div id="custom-search-input">
                    <div class="input-group">
                        <input type="text" class="form-control" value=""
                               placeholder="Search a Topic" name="search"/>
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
                <a class="btn btn-primary" href="{{ route('admin.topics.create')}}" }}>
                    <i class="fa fa-plus"></i>&nbsp;&nbsp;Add
                </a>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Country</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Sub Topics</th>
                        <th>Status</th>
                        <th>
                            <a class="btn btn-sm btn-danger" href="{{route('admin.topics.delete-all')}}" type="submit">
                                 <i class="fa fa-trash">Delete all</i>
                            </a>
                        </th>
                    </tr>
                    </thead>
                    <tbody id="items">
                    @forelse($records as $record)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $record->country->name }}</td>
                            <td>{{ $record->name }}</td>
                            <td>{{ $record->slug }}</td>
                            <td><a href="{{ route('admin.topics.index',['parent_id' => $record->id])}}">{{ $record->children->count() }}</a></td>
                            <td>
                                @if($record->status)
                                {{ 'Active' }}
                                @else
                                {{ 'Inactive'}}
                                @endif</td>
                            <td>
                               <div class="d-inline-flex">
                                    <a href="{{ route('admin.countries.changeStatus',[$record->id]) }}" class="btn btn-primary btn-sm mr-1">
                                       @if($record->status)
                                            <i class="fa fa-check"></i>
                                       @else
                                            <i class="fa fa-times"></i>
                                        @endif     
                                   </a>
                                   <a href="{{ route('admin.topics.edit',[$record->id]) }}" class="btn btn-primary btn-sm mr-1">
                                       <i class="fa fa-edit"></i>
                                   </a>
                                   <form action="{{ route('admin.topics.destroy',[$record->id]) }}" method="POST">
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
                            <td>No topics Found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            {{ $records->links() }}
        </div>
    </div>

@endsection