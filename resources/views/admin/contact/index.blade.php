@extends('layouts.main')

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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Subject</th>
                        <th>Action</th>   
                    </tr>
                    </thead>
                    <tbody id="items">
                    @forelse($records as $record)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $record->name }}</td>
                            <td>{{ $record->email }}</td>
                            <td>{{ $record->phone }}</td>
                            <td>{{ $record->subject }}</td>
                            <td>
                               <div class="d-inline-flex">
                                   <a href="{{ route('admin.contact.show',[$record->id]) }}" class="btn btn-primary btn-sm mr-1">
                                       <i class="fa fa-eye"></i>
                                   </a>
                                   <form action="{{ route('admin.contact.destroy',[$record->id]) }}" method="POST">
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