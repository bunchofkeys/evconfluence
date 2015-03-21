@extends('layout.master.home')

@section('content')
    <div id="login-page">
        <div class="container">

            {{ Form::open(['route' => 'session.saveUserRegister', 'class' => 'form-login form-horizontal style-form', 'style' => 'max-width: 800px']) }}
            <h2 class="form-login-heading">REGISTRATION</h2>
            <div class="login-wrap">
                <div class="form-group @if(MessageService::has('email')) has-error @endif">
                    <label class="col-sm-2 col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="email" value="{{ Input::old('email') }}">
                    </div>
                </div>
                <div class="form-group @if(MessageService::has('first_name')) has-error @endif">
                    <label class="col-sm-2 col-sm-2 control-label">First Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="first_name" value="{{ Input::old('first_name') }}">
                    </div>
                </div>
                <div class="form-group @if(MessageService::has('last_name')) has-error @endif">
                    <label class="col-sm-2 col-sm-2 control-label">Last Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="last_name" value="{{ Input::old('last_name') }}">
                    </div>
                </div>
                <div class="form-group @if(MessageService::has('school')) has-error @endif">
                    <label class="col-sm-2 col-sm-2 control-label">School</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="school" value="{{ Input::old('school') }}">
                    </div>
                </div>
                <div class="form-group @if(MessageService::has('unit_required_for')) has-error @endif">
                    <label class="col-sm-2 col-sm-2 control-label">Unit Required For</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="unit_required_for" value="{{ Input::old('unit_required_for') }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button class="btn btn-theme col-sm-4 col-sm-offset-2" type="submit"> Submit </button>
                        <a class="btn btn-default col-sm-4 col-sm-offset-1" href="{{ URL::route('session.login') }}"> Cancel </a>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop