@extends('layout.master.inner_two')

@section('sidebar')
    @include('layout.partial.teacher.side_menu')
@endsection

@section('content')

    <div class="row mt">
        <div class="col-md-12" style="padding-bottom: 20px">
            <a href="{{ URL::route('teacher.form.response',['period' => $periodId, 'form' => $formId]) }}" class="btn btn-primary">Back</a>
        </div>
        <div class="col-md-12">
            @if($submission->alert == '1')
                <div class="alert alert-danger">
                    <h5><b>This student have requested for your attention to this evaluation.</b></h5>
                </div>
            @endif

            <div class="form-horizontal style-form showback">
                <h3>{{$self->person->first_name}} {{$self->person->last_name}}'s Self Evaluation </h3>
                <table class="table table-striped table-advance table-hover">
                        <thead>
                        <tr>
                            <th class="col-md-4">Question</th>
                            <th class="col-md-8">Response</th>
                        </tr>
                        </thead>
                    <tbody>
                    @foreach($self->question as $question)
                    <tr>
                        <td>{{ $question->question_text }}</td>
                        <td>{{$question->answer->input}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- /col-md-12 -->

        @foreach($peerList as $peer)
            <div class="col-md-12">
                <div class="form-horizontal style-form showback">
                    <h3>{{$self->person->first_name}} {{$self->person->last_name}}'s Peer Evaluation for {{$peer->person->first_name}} {{$peer->person->last_name}} </h3>
                        <table class="table table-striped table-advance table-hover">
                            <thead>
                            <tr>
                                <th class="col-md-4">Question</th>
                                <th class="col-md-8">Response</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($peer->question as $question)
                                <tr>
                                    <td>{{ $question->question_text }}</td>
                                    <td>{{$question->answer->input}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                </div>
            </div><!-- /col-md-12 -->
        @endforeach
    </div>
@endsection

