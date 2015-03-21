@extends('layout.master.inner_two')

@section('sidebar')
    @include('layout.partial.teacher.side_menu')
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="form-panel">
            {{ Form::open(['class' => 'form-horizontal style-form']) }}
            <h2 class="mb">New Form</h2>

            <div class="form-group @if(MessageService::has('name')) has-error @endif">
                <label class="col-sm-4 col-sm-4 control-label">Name of Form</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="name" value="{{ Input::old('name') }}">
                </div>
            </div>
            <div class="form-group @if(MessageService::has('end_date_time')) has-error @endif">
                <label class="col-sm-4 col-sm-4 control-label">End Date & Time</label>
                <div class="col-sm-8">
                    <input id="dateEnd" type="text" class="form-control" name="end_date_time" value="{{ Input::old('end_date_time') }}">
                </div>
            </div>
            <div class="form-group @if(MessageService::has('defaultQuestion')) has-error @endif">
                <label class="col-sm-4 control-label">Add default questions template? </label>
                <div class="col-sm-8">
                    <div class="checkbox checkbox-inline">
                        <label>
                            <input type="radio" name="defaultQuestion" id="option-defaultQuestion" value="true"
                            @if(Input::old('defaultQuestion') == 'true') checked="checked" @endif>
                            Yes </input>
                        </label>
                        <label>
                            <input type="radio" name="defaultQuestion" id="option-defaultQuestion" value="false"
                            @if(Input::old('defaultQuestion') == 'false') checked="checked" @endif>
                            No </input>
                        </label>
                    </div>
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