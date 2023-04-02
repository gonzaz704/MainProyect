@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Contact Us</div>

                <div class="panel-body">
                    @include('alerts.success')
                    <form class="form-horizontal" method="POST" action="{{ route('contact.store') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} col-sm-12">
                            <label for="name" class="control-label">Name</label>

                            <input id="name" type="name" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} col-sm-12">
                            <label for="email" class="control-label">E-Mail Address</label>

                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required >
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                         <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }} col-sm-12">
                            <label for="phone" class="control-label">Phone</label>

                            <input id="phone" type="phone" class="form-control" name="phone" value="{{ old('phone') }}" required >
                            @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>
                         <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }} col-sm-12">
                            <label for="subject" class="control-label">Subject</label>
                            <input id="subject" type="subject" class="form-control" name="subject" value="{{ old('subject') }}" required >
                            @if ($errors->has('subject'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('subject') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }} col-sm-12">
                            <label for="message" class="control-label">Message</label>
                            <textarea type="text" class="form-control" id="message" name="message"></textarea>
                            @if ($errors->has('message'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('message') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary">
                                    Send
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
