@extends('layout.master.inner_two')

@section('sidebar')
    @include('layout.partial.teacher.side_menu')
@endsection

@section('content')
    <div class="row mt">
        <h1> Submission of {{$self->person->first_name}} {{$self->person->last_name}} </h1 >
        <div class="col-md-12">
            <div class="form-horizontal style-form showback">
                <div class="form-group">
                    <h3><i class="fa fa-angle-right"></i> Self Evaluation </h3>
                </div>
                @foreach($self->question as $question)
                    <div class="form-group">
                        <label class="col-sm-4 col-sm-4 control-label">{{ $question->question_text }}</label>
                        <div class="col-sm-8">
                            <p>
                                {{$question->answer->input}}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div><!-- /col-md-12 -->

        @foreach($peerList as $peer)
            <div class="col-md-12">
                <div class="form-horizontal style-form showback">
                    <div class="form-group">
                        <h3><i class="fa fa-angle-right"></i> Peer Evaluation: {{$peer->person->first_name}} {{$peer->person->last_name}} </h3>
                    </div>
                    @foreach($peer->question as $question)
                        <div class="form-group">
                            <label class="col-sm-4 col-sm-4 control-label">{{ $question->question_text }}</label>
                            <div class="col-sm-8">
                                <p>
                                    {{$question->answer->input}}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div><!-- /col-md-12 -->
        @endforeach
    </div>
@endsection

