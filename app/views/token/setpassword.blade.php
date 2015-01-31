@extends('layout.master.inner_one')

@section('content')
<div class="col-lg-6">
    <div class="form-panel">
        <h4 class="mb">Set Password </h4>
        <p>
            Please set your password for {{ $person->user->username }}
        </p>
        {{ Form::open(['method' => 'post', 'class' => 'form-horizontal style-form']) }}
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
        <div align="center" >
            <button type="submit" class="btn btn-success" name="Submit" value="save">Save Changes</button>
        </div>
        {{ Form::close() }}

    </div>
</div>

@endsection