@extends('layout.master.inner_two')

@section('sidebar')
    @include('layout.partial.admin.side_menu')
@endsection

<script src="/assets/js/jquery.js"></script>
<script type="text/javascript">

    $(document).ready(function(){
        checkRole();
    });

    function checkRole()
    {
        if($('#roleSelection').val() == 'Teacher')
        {
            $('.optional-teacher').show();
        }
        else
        {
            $('.optional-teacher').hide();
        }
    }

</script>

@section('content')
    <div class="col-lg-12">
        <div class="form-panel">
            {{ Form::open(['class' => 'form-horizontal style-form']) }}
            <h2 class="mb">New User</h2>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Role</label>
                    <div class="col-sm-10">
                        <select id="roleSelection" class="form-control" name="role" onchange="checkRole()">
                            <option @if(Input::old('role') == 'Admin')selected="true"@endif value="Admin">Admin</option>
                            <option @if(Input::old('role') == 'Teacher')selected="true"@endif value="Teacher">Teacher</option>
                        </select>
                    </div>
                </div>
                <div class="form-group @if($errors->has('email')) has-error @endif">
                    <label class="col-sm-2 col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="email" value="{{ Input::old('email') }}">
                    </div>
                </div>
                <div class="form-group @if($errors->has('first_name')) has-error @endif">
                    <label class="col-sm-2 col-sm-2 control-label">First Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="first_name" value="{{ Input::old('first_name') }}">
                    </div>
                </div>
                <div class="form-group @if($errors->has('last_name')) has-error @endif">
                    <label class="col-sm-2 col-sm-2 control-label">Last Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="last_name" value="{{ Input::old('last_name') }}">
                    </div>
                </div>

                <div class="form-group optional-teacher @if($errors->has('school')) has-error @endif">
                    <label class="col-sm-2 col-sm-2 control-label">School</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="school" value="{{ Input::old('school') }}">
                    </div>
                </div>
                <div class="form-group optional-teacher @if($errors->has('unit_required_for')) has-error @endif">
                    <label class="col-sm-2 col-sm-2 control-label">Unit Required For</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="unit_required_for" value="{{ Input::old('unit_required_for') }}">
                    </div>
                </div>
                <div class="form-group @if($errors->has('password') || $errors->has('confirm_password')) has-error @endif">
                    <label class="col-sm-2 col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>
                <div class="form-group @if($errors->has('password') || $errors->has('confirm_password')) has-error @endif">
                    <label class="col-sm-2 col-sm-2 control-label">Confirm Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="confirm_password">
                    </div>
                </div>

                <div align="center" >
                    <button type="submit" class="btn btn-success">Create User</button>
                    <a href="{{ URL::route('admin.user.index') }}" class="btn btn-primary">Back</a>
                </div>

                {{ Form::close() }}
        </div>
    </div>

@endsection