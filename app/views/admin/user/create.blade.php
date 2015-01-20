@extends('layout.master.inner_two')

@section('content')
    <div class="col-lg-12">
        <div class="form-panel">
            {{ Form::open(['class' => 'form-horizontal style-form']) }}
            <h2 class="mb">New User</h2>
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
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Confirm Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="confirm_password">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Role</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="role">
                            <option value="Admin">Admin</option>
                            <option value="Staff">Staff</option>
                        </select>
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