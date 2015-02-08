@extends('layout.master.inner_two')

@section('sidebar')
    @include('layout.partial.teacher.side_menu')
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="form-panel">
            {{ Form::open(['class' => 'form-horizontal style-form']) }}
            <h2 class="mb">New {{ $type }} Evaluation Question</h2>
            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Question</label>
                <div class="col-sm-10">
                    <input id="dateStart" type="text" class="form-control" name="question_text">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Format</label>
                <div class="col-sm-10">
                    <select class="form-control" name="question_format">
                        <option selected="true" value="Multi">Multiple Choice</option>
                        <option value="Open">Open Ended Question</option>
                    </select>
                </div>
            </div>
            <div align="center" >
                <button type="submit" class="btn btn-success">Create</button>
                <a href="{{ URL::route('teacher.form.question', ['period' => $period, 'form' => $form, 'type' => $type]) }}" class="btn btn-primary">Back</a>
            </div>

            {{ Form::close() }}
        </div>
    </div>

@endsection