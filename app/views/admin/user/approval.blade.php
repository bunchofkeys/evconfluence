@extends('layout.master.inner_two')

@section('sidebar')
    @include('layout.partial.admin.side_menu')
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="form-panel">

            <h4 class="mb"><i class="fa fa-angle-right"></i> Application Number: {{$user->user_id}}</h4>
            {{ Form::open(['method' => 'post', 'class' => 'form-horizontal style-form']) }}

            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <p> {{$user->username }} </p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">First Name</label>
                <div class="col-sm-10">
                    <p> {{$user->person->first_name}} </p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Last Name</label>
                <div class="col-sm-10">
                    <p> {{$user->person->last_name}} </p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">School</label>
                <div class="col-sm-10">
                    <p> {{$user->teacher->school}} </p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Unit Required For</label>
                <div class="col-sm-10">
                    <p> {{$user->teacher->unit_required_for}} </p>
                </div>
            </div>

            <div align="center" >
                <button type="submit" class="btn btn-success" name="approve" value="save">Approve</button>
                <button type="submit" class="btn btn-danger" name="reject" value="delete">Reject</button>
                <a href="{{ URL::route('admin.user.index') }}" class="btn btn-primary">Back</a>
            </div>
            {{form::close()}}
        </div>
    </div>

@endsection