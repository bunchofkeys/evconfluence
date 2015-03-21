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
                        <div class="form-group">
                            <label class="col-sm-4 col-sm-4 control-label">{{$question->question_text}}  <a data-toggle="modal" href="#multiInputModal"><i class="fa fa-question-circle"></i>
                                </a></label>

                            <div class="col-sm-8">
                                @for ($i = 1; $i <= 5; $i++)
                                <div class="radio checkbox-inline">
                                    <label>
                                        <input type="radio" name="question-{{$question->question_id}}" id="option-{{$question->question_id}}" value={{$i}}
                                                @if($i == $question->answer)checked="checked"@endif>
                                        {{$i}} </input>
                                    </label>
                                </div>
                                @endfor
                            </div>

                        </div>
                    @else
                        <div class="form-group">
                            <label class="col-sm-4 col-sm-4 control-label">{{$question->question_text}}  <a data-toggle="modal" href="#textInputModal"><i class="fa fa-question-circle"></i></a></label>
                            <div class="col-sm-8">
                                <textarea rows="5" class="form-control" name="question-{{$question->question_id}}">{{$question->answer}}</textarea>
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

    <!-- multiChoice Modal -->
    <div aria-hidden="true" aria-labelledby="multiInputModal" role="dialog" tabindex="-1" id="multiInputModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <h4>Instructions</h4>
                <p>Multi choice</p>
            </div>
        </div>
    </div>
    <!-- modal -->

    <!-- textInputModal Modal -->
    <div aria-hidden="true" aria-labelledby="textInputModal" role="dialog" tabindex="-1" id="textInputModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <h4>Instructions</h4>
                <p>Multi choice</p>
            </div>
        </div>
    </div>
    <!-- modal -->
@stop