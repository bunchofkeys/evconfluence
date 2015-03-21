@extends('layout.master.inner_two')

@section('sidebar')
    @include('layout.partial.teacher.side_menu')
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="form-panel">
            {{ Form::open(['class' => 'form-horizontal style-form']) }}
            <h2 class="mb">Edit Teaching Period</h2>
            <div class="form-group @if(MessageService::has('semester_code')) has-error @endif">
                <label class="col-sm-2 col-sm-2 control-label">Semester</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="semester_code" value="@if(MessageService::has('semester_code')){{Input::old('semester_code')}} @else{{$period->semester_code}}@endif">
                </div>
            </div>
            <div class="form-group @if(MessageService::has('year')) has-error @endif">
                <label class="col-sm-2 col-sm-2 control-label">year</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="year" value="@if(MessageService::has('year')){{Input::old('year')}} @else{{$period->year}}@endif">
                </div>
            </div>
            <div class="form-group @if(MessageService::has('unit_code')) has-error @endif">
                <label class="col-sm-2 col-sm-2 control-label">Unit code</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="unit_code" value="@if(MessageService::has('unit_code')){{Input::old('unit_code')}} @else{{$period->unit_code}}@endif">
                </div>
            </div>

            <div align="center" >
                <button type="submit" class="btn btn-success" name="save" value="save">Save</button>
                <button type="submit" class="btn btn-danger" name="delete" value="delete">Delete</button>
                <a href="{{ URL::route('teacher.period.index') }}" class="btn btn-primary">Back</a>
            </div>

            {{ Form::close() }}
        </div>
    </div>

@endsection