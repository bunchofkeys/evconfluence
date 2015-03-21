@extends('layout.master.home')

@section('content')
    <script type="text/javascript">

        $(window).resize(function() {
            $windowWidth = $(window).width();
            checkSize($windowWidth);
        });

        $( document ).ready(function() {
            checkSize($windowWidth);

        });

        function checkSize($width)
        {
            if ($width <= 1024)
            {
                $('#buttonGroup').removeClass('btn-group-justified');
            }
            else
            {
                $('#buttonGroup').addClass('btn-group-justified');
            }
        }

    </script>
    <div class="row mt">
        <div class="col-lg-10 col-lg-offset-1">
            <div id="buttonGroup" class="btn-group btn-group-justified">
                <div class="btn-group">
                    @if($target->student_id == $self->student_id)
                        <a class="btn btn-success"
                    @else
                        <a class="btn btn-default"
                           @endif
                           href="{{URL::route('token.evaluation.form', ['token' => $token,
                                                                        'selfId' => $self->student_id,
                                                                        'targetId' =>  $self->student_id,
                                                                        'form' => $form->form_id])}}">
                            Self: {{$self->person->first_name}} {{$self->person->last_name}}
                        </a>
                </div>
                @foreach($peerList as $peer)
                    <div class="btn-group">
                        @if($target->student_id == $peer->student_id)
                            <a class="btn btn-success"
                        @else
                            <a class="btn btn-default"
                               @endif

                               href="{{URL::route('token.evaluation.form', ['token' => $token,
                                                                        'selfId' => $self->student_id,
                                                                        'form' => $form->form_id,
                                                                        'targetId' => $peer->student_id])}}">
                                Peer: {{$peer->person->first_name}} {{$peer->person->last_name}}
                            </a>
                    </div>

                @endforeach
                <div class="btn-group">
                    <a href="{{URL::route('token.evaluation.confirm', ['token' => $token,
                                                                        'selfId' => $self->student_id,
                                                                        'form' => $form->form_id,])}}"
                       class="btn btn-default">Confirmation</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="showback">
                {{ Form::open(['class' => 'form-horizontal style-form']) }}
                <div class="form-group">
                    <h3><i class="fa fa-angle-right"></i> {{$title}}</h3>
                </div>
                @foreach($questions as $question)
                    @if($question->format == 'Multi')
                        <div class="form-group @if(MessageService::has('question_text')) has-error @endif">
                            <label class="col-sm-4 col-sm-4 control-label">{{$question->question_text}}</label>
                            <div class="col-sm-3">
                                @for ($i = 1; $i <= 5; $i++)
                                    <div class="radio checkbox-inline">
                                        <label>

                                            <input type="radio" name="{{$question->question_text}}" id="option-{{$question->question_id}}" value={{$i}}
                                            @if($i == $question->answer) checked="checked" @elseif(MessageService::has($question->question_text))
                                                   @if($i == Input::old($question->question_text)) checked="checked" @endif @endif>
                                            {{$i}} </input>
                                        </label>
                                    </div>
                                @endfor
                            </div>
                            <div class="col-sm-1">
                                <label>
                                    <a data-toggle="modal" href="#multiInputModal"><i class="fa fa-question-circle fa-2x"></i></a>
                                </label>
                            </div>

                        </div>
                    @else
                        <div class="form-group @if(MessageService::has($question->question_text)) has-error @endif">
                            <label class="col-sm-4 col-sm-4 control-label">{{$question->question_text}}</label>
                            <div class="col-sm-7">
                                <textarea rows="5" class="form-control" name="{{$question->question_text}}">@if(MessageService::has($question->question_text)){{Input::old($question->question_text)}}@else{{$question->answer}}@endif</textarea>
                            </div>
                            <div class="col-sm-1">
                                <label>
                                    <a data-toggle="modal" href="#textInputModal"><i class="fa fa-question-circle fa-2x"></i></a>
                                </label>
                            </div>
                        </div>
                    @endif
                @endforeach

                <div align="center" >
                    <button type="submit" class="btn btn-success">Next</button>
                    {{--                    <a href="{{ URL::route('teacher.form.index', ['period' => $period]) }}" class="btn btn-primary">Back</a>--}}
                </div>
                {{ Form::close() }}
            </div>
        </div><!-- col-lg-12-->
    </div>

    <!-- multiChoice -->
    <div aria-hidden="true" aria-labelledby="multiInputModal" role="dialog" tabindex="-1" id="multiInputModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="ds">
                    <h3>You need to fill in a mark from the scale for each of the performance criteria. </h3>
                </div>
                <section class="task-panel tasks-widget">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h4> The scales are from 1 to 5.  Assess these as:</h4></div>
                        <br>
                    </div>
                    <div class="panel-body">
                        <div class="task-content">

                            <ul class="task-list">
                                <li>
                                    <span class="task-title-sp">1 = Very poor, or even obstructive, contribution to the project process </span>
                                </li>
                                <li>
                                    <span class="task-title-sp">2 = Poor contribution to the project process </span>
                                </li>
                                <li>
                                    <span class="task-title-sp">3 = acceptable contribution to the project process </span>
                                </li>
                                <li>
                                    <span class="task-title-sp">4 = good contribution to the project process </span>
                                </li>
                                <li>
                                    <span class="task-title-sp">5 = excellent contribution to the project process </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- modal -->

    <!-- textInputModal -->
    <div aria-hidden="true" aria-labelledby="textInputModal" role="dialog" tabindex="-1" id="textInputModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="ds">
                    <h3>You need to do a writeup on the person you are evaluating. </h3>
                </div>
                <br/>
            </div>
            </div>
        </div>
    </div>
    <!-- modal -->
@stop