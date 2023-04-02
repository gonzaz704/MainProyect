@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            @include('alerts.success')
            <form method="GET" action="{{ route('admin.users.index')  }}" accept-charset="UTF-8">
                <div id="custom-search-input">
                    <div class="input-group">
                        <input type="text" class="form-control" value=""
                               placeholder="Search a User" name="search"/>
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Followers</th>
                        <th>Following</th>
                        <th>Papers</th>
                        <th>Points</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="items">
                        @forelse($users as $user)
                        
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->followers->count() }}</td>
                                <td>{{ $user->following->count() }}</td>
                                <td>{{ $user->papers->count() }}</td>
                                <td>{{ $user->userrank ? $user->userrank->point : 0 }}</td>
                                <td>
                                    <div class="d-inline-flex">
                                        <a href="{{ route('admin.users.show',[$user->id]) }}" class="btn btn-primary btn-sm mr-1">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.users.destroy',[$user->id]) }}" method="POST">
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
                                <td>No Users Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $users->links() }}
        </div>
    </div>

@endsection