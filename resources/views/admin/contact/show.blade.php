@extends('layouts.main')
@section('content')
    <div class="col-sm-12">
        <div class="post-slide">
            <div class="post-content">
                <h3 class="post-title"><a href="#">{{ $model->subject }}</a></h3>
                
                <ul class="post-bar">
                    <li><i class="fa fa-user"></i>
                        Name : <strong>{{ $model->name }}</strong>
                    </li>
                    <li><i class="fa fa-envelope"></i>
                        Email : <strong>{{ $model->email }}</strong>
                    </li>
                    <li><i class="fa fa-phone"></i>
                        Phone : <strong>{{ $model->phone }}</strong>
                    </li>
                    <li><i class="fa fa-comment"></i>
                        Message : <strong>{{ $model->message }}</strong>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
