@extends('layout.master.inner_two')

@section('sidebar')
    @include('layout.partial.teacher.side_menu')
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="form-panel">
            {{ Form::open(['class' => 'form-horizontal style-form', 'files' => 'true']) }}
            <h2 class="mb">Upload Csv list
                <label>
                    <a data-toggle="modal" href="#Modal"><i class="fa fa-question-circle fa-1x"></i></a>
                </label>
            </h2>

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

    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="Modal" role="dialog" tabindex="-1" id="Modal" class="modal fade">
        <div class="modal-dialog" style="min-width: 700px;">
            <div class="modal-content">
                <div class="ds">
                    <h3>Guide to upload CSV </h3>
                </div>
                <div class="panel-body">
                    <div class="task-content">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h4>The CSV file must be formated in the following
                                </h4></div>
                            <br>
                        </div>
                        <img src="/assets/img/samplecsv.png">

                    </div>
                </div>
                <br/>
            </div>
        </div>
    </div>
@endsection