@extends('layouts.papers')

@section('content')
    

<div class="center-fluid">

	@foreach($followers as $follower)
		<div class="col-sm-4">
			<div class="card" align="center">
				<div class="card-block">

					<h4 class="card-subtitle">
						{{ $follower->followers->name }}
					</h4>


					<a href="{{ route('user.profile', [ 'id' => $follower->user_id] ) }}">

						<img src="{{'images/' . $follower->followers->foto }}" height="200px" width="170px">

					</a>

					<br/>

					<span>Papers: {{  $follower->followers->papers->count()}} </span>

					<br/>

				</div>
			</div>
		</div>

	@endforeach
	

</div>



@endsection
