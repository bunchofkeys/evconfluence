@extends('layout.master.inner_two')

@section('sidebar')
    @include('layout.partial.teacher.side_menu')
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="form-panel">
            {{ Form::open(['class' => 'form-horizontal style-form']) }}
            <h2 class="mb">New Student</h2>
            <div class="form-group @if($errors->has('student_id')) has-error @endif">
                <label class="col-sm-2 col-sm-2 control-label">Student ID</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="student_id" value="{{ Input::old('student_id') }}">
                </div>
            </div>
            <div class="form-group @if($errors->has('team_id')) has-error @endif">
                <label class="col-sm-2 col-sm-2 control-label">Team ID</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="team_id" value="{{ Input::old('team_id') }}">
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

            <div align="center" >
                <button type="submit" class="btn btn-success">Create Student</button>
                <a href="{{ URL::route('teacher.student.index', ['period' => $period]) }}" class="btn btn-primary">Back</a>
            </div>

            {{ Form::close() }}
        </div>
    </div>

@endsection