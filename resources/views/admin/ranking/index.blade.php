@extends('layouts.papers')

@section('content')
    <div class="row">
        <div class="col-sm-12">
          <h1>User ranking</h1>
          @if ($users->count())
          <table class="table mt-3">
            <thead>
              <th>Position</th>
              <th>User</th>
              <th>Type</th>
              <th>Total points</th>
            </thead>
            <tbody>
              @foreach ($users as $user)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->type}}</td>
                  <td>{{ $user->points}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
          @else
          <span class="text-muted text-center">There are not user with ranking points yet.</span>
          @endif
        </div>
    </div>
@endsection