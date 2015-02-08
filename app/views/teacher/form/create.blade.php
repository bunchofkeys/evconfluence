@extends('layout.master.inner_two')

@section('sidebar')
    @include('layout.partial.teacher.side_menu')
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="form-panel">
            {{ Form::open(['class' => 'form-horizontal style-form']) }}
            <h2 class="mb">New Form</h2>
            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Start Date & Time</label>
                <div class="col-sm-10">
                    <input id="dateStart" type="text" class="form-control" name="start_date_time">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">End Date & Time</label>
                <div class="col-sm-10">
                    <input id="dateEnd" type="text" class="form-control" name="end_date_time">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Enabled</label>
                <div class="task-checkbox col-sm-10">
                    <input type="checkbox" class="list-child" name="status">
                </div>
            </div>
            <div align="center" >
                <button type="submit" class="btn btn-success">Create</button>
                <a href="{{ URL::route('teacher.form.index', ['period' => $period]) }}" class="btn btn-primary">Back</a>
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