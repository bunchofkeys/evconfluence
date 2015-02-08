@extends('layout.master.inner_two')

@section('sidebar')
    @include('layout.partial.teacher.side_menu')
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="form-panel">
            {{ Form::open(['class' => 'form-horizontal style-form', 'files' => 'true']) }}
            <h2 class="mb">Upload Csv list</h2>
            <div class="form-group">
                <div class="col-sm-12">
                    {{Form::file('file', ['class' => 'form-control'])}}
                </div>
            </div>
            <div align="center" >
                <button type="submit" class="btn btn-success">Upload</button>
                <a href="{{ URL::route('teacher.period.index') }}" class="btn btn-primary">Back</a>
            </div>

            {{ Form::close() }}
        </div>
    </div>

@endsection