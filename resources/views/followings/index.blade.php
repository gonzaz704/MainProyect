@extends('layouts.papers')

@section('content')
    

<div class="center-fluid">

	@foreach($followings as $following)


	    <div class="col-sm-4">
	        <div class="card" align="center">
	        	<div class="card-block">
	                
	            	<h4 class="card-subtitle">
	            		{{ $following->followings->name }}
	            	</h4>

	                
                    <a href="{{ route('user.profile', [ 'id' => $following->following_id] ) }}">

                    	<img src="{{'images/' . $following->followings->foto }}" height="200px" width="170px">

                	</a>
                       
                    <br/>
                    
                    <span>Papers: {{  $following->followings->papers->count()}} </span> 
                    
                    <br/>

				</div>
			</div>
		</div>
	
	@endforeach

</div>



@endsection
