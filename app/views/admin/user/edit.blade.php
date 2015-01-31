@extends('layout.master.inner_two')

@section('sidebar')
    @include('layout.partial.admin.side_menu')
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="form-panel">
            @if(empty($messages) == false)
                @foreach($messages as $key => $value)
                    <div class="alert alert-{{$key}} alert-dismissable"> {{$value}} </div>
                @endforeach
            @endif
            <h4 class="mb"><i class="fa fa-angle-right"></i> Details for {{$user->username }}</h4>
                {{ Form::open(['method' => 'put', 'class' => 'form-horizontal style-form']) }}
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">First Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="first_name" value="{{$user->person->first_name}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Last Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="last_name" value="{{$user->person->last_name}}">
                    </div>
                </div>
                @if($user->role == 'Teacher')
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">School</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="school" value="{{$user->teacher->school}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Unit Required For</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="unit_required_for" value="{{$user->teacher->unit_required_for}}">
                    </div>
                </div>
                @endif
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
                    <button type="submit" class="btn btn-success" name="save" value="save">Save Changes</button>
                    <button type="submit" class="btn btn-danger" name="delete" value="delete">Delete User</button>
                    <a href="{{ URL::route('admin.user.index') }}" class="btn btn-primary">Back</a>
                </div>
                {{ Form::close() }}

        </div>
    </div>

@endsection