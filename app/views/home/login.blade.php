@extends('layout.master.home')

@section('content')
    <div id="login-page">
        <div class="container">
            {{ Form::open(['route' => 'session.auth', 'class' => 'form-login']) }}
                <h2 class="form-login-heading">SPE System Login</h2>
                <div class="login-wrap">

                    {{ Form::text('username', '', ['placeholder' => 'Email',  'class' => 'form-control', 'autofocus' => 'true']) }}
                    <br>
                    {{ Form::password('password', ['placeholder' => 'Password',  'class' => 'form-control']) }}
                    <label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="{{ URL::route('session.forgetPassword') }}"> Forgot Password?</a>

		                </span>
                    </label>
                        <button class="btn btn-theme btn-block" type="submit"> <i class="fa fa-lock"> SIGN IN </i></button>
                    <hr>
                    <div class="registration">
                        Don't have an account yet?<br/>
                            <a href="{{ URL::route('session.userRegister') }}" class="btn btn-theme">Register</a>
                    </div>

                </div>
            {{ Form::close() }}


                <!-- Forgot password Modal -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="forgetPasswordModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Forgot Password ?</h4>
                            </div>
                            {{ Form::open(['route' => 'session.forgetPassword', 'method' => 'post']) }}

                            <div class="modal-body">
                                    <p>Enter your e-mail address below to reset your password.</p>
                                    <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
                            </div>
                            <div class="modal-footer">
                                <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                                <button class="btn btn-theme" type="submit">Submit</button>
                            </div>
                            {{ Form::close() }}

                        </div>
                    </div>
                </div>
                <!-- modal -->



        </div>
    </div>
@stop