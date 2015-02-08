@extends('layout.master.home')

@section('content')
    <div id="login-page">
        <div class="container">

            {{ Form::open(['route' => 'session.saveUserRegister', 'class' => 'form-login form-horizontal style-form', 'style' => 'max-width: 800px']) }}
            <h2 class="form-login-heading">REGISTRATION</h2>

            <div class="login-wrap">

                @if ($errors->has('error'))
                    <p style="color: red"><b> {{$errors->first('error')}} </b></p>
                    </br>
                @endif
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">First Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="first_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Last Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="last_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">School</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="school" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Unit Required For</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="unit_required_for">
                        </div>
                    </div>
                <button class="btn btn-theme btn-block" type="submit"> <i class="fa fa-lock"> REGISTER </i></button>

                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop