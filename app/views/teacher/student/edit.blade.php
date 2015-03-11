@extends('layout.master.inner_two')

@section('sidebar')
    @include('layout.partial.teacher.side_menu')
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="form-panel">
            {{ Form::open(['class' => 'form-horizontal style-form']) }}
            <h2 class="mb">New Student</h2>
            <div class="form-group @if($errors->has('team_id')) has-error @endif">
                <label class="col-sm-2 col-sm-2 control-label">Team ID</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="team_id"
                           value="@if(Request::isMethod('post'))Input::old('team_id')
                                   @else{{$student->team($period)->team_id}}@endif">
                </div>
            </div>
            <div class="form-group @if($errors->has('email')) has-error @endif">
                <label class="col-sm-2 col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="email"
                           value="@if(Request::isMethod('post'))Input::old('email')
                                   @else{{$student->person->email}}@endif">
                </div>
            </div>
            <div class="form-group @if($errors->has('first_name')) has-error @endif">
                <label class="col-sm-2 col-sm-2 control-label">First Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="first_name"
                           value="@if(Request::isMethod('post'))Input::old('first_name')
                                   @else{{$student->person->first_name}}@endif">
                </div>
            </div>
            <div class="form-group @if($errors->has('last_name')) has-error @endif">
                <label class="col-sm-2 col-sm-2 control-label">Last Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="last_name"
                           value="@if(Request::isMethod('post'))Input::old('last_name')
                                   @else{{$student->person->last_name}}@endif">
                </div>
            </div>

            <div align="center" style="text-align:center;" >
                <button type="submit" class="btn btn-success">Save</button>

            </div>

            {{ Form::close() }}

            {{ Form::open( ['method' => 'delete']) }}

            <div align="center" style="text-align:center;" >
                <button type="submit" class="btn btn-danger">Delete</button>
                <a href="{{ URL::route('teacher.student.index', ['period' => $period]) }}" class="btn btn-primary">Back</a>
            </div>
            {{ Form::close() }}

        </div>
    </div>

@endsection