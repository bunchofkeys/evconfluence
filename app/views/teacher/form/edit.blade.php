@extends('layout.master.inner_two')

@section('sidebar')
    @include('layout.partial.teacher.side_menu')
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="form-panel">
            {{ Form::open(['class' => 'form-horizontal style-form']) }}
            <h2 class="mb">Edit Form</h2>

            <div class="form-group @if(MessageService::has('name')) has-error @endif">
                <label class="col-sm-2 col-sm-2 control-label">Name of Form</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" value="@if(MessageService::has('name')){{Input::old('name')}} @else{{$form->name}}@endif">
                </div>
            </div>
            <div class="form-group @if(MessageService::has('end_date_time')) has-error @endif">
                <label class="col-sm-2 col-sm-2 control-label">End Date & Time</label>
                <div class="col-sm-10">
                    <input id="dateEnd" type="text" class="form-control" name="end_date_time"
                           value="@if(MessageService::has('name')){{Input::old('end_date_time')}}@else{{$form->end_date_time}}@endif">
                </div>
            </div>
            <div align="center" >
                <button type="submit" class="btn btn-success" name="save" value="save">Save</button>
                <button type="submit" class="btn btn-danger" name="delete" value="delete">Delete</button>
                <a href="{{ URL::route('teacher.form.index', ['period' => $period->period_id]) }}" class="btn btn-primary">Back</a>
            </div>

            {{ Form::close() }}
        </div>
    </div>
    <script type="text/javascript">
        $('#dateStart').datetimepicker({
            format:'d.m.Y H:i'
        });
        $('#dateEnd').datetimepicker({
            format:'d.m.Y H:i'
        });
    </script>
@endsection