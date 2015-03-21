@extends('layout.master.home')

@section('content')
    <div id="login-page">
        <div class="container">

            {{ Form::open(['route' => 'session.storeForgetPassword', 'class' => 'form-login form-horizontal style-form']) }}
            <h2 class="form-login-heading">Forget Password</h2>
            <div class="login-wrap">

                <div class="form-group @if(MessageService::has('email')) has-error @endif">
                    <label class="col-sm-2 col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="email" value="{{ Input::old('email') }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button class="btn btn-theme col-sm-5 col-sm-offset-1" type="submit"> Submit </button>
                        <a class="btn btn-default col-sm-5 col-sm-offset-1" href="{{ URL::route('session.login') }}"> Cancel </a>
                    </div>
                </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop