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
            if ($width <= 500)
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
                        <a class="btn btn-default" href="{{URL::route('token.evaluation.form', ['token' => $token,
                                                                        'selfId' => $self->student_id,
                                                                        'targetId' =>  $self->student_id,
                                                                        'form' => $form->form_id])}}">
                            Self: {{$self->person->first_name}} {{$self->person->last_name}}
                        </a>
                </div>
                @foreach($peerList as $peer)
                    <div class="btn-group">
                            <a class="btn btn-default" href="{{URL::route('token.evaluation.form', ['token' => $token,
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
                       class="btn btn-success">Confirmation</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="showback">
                {{ Form::open(['class' => 'form-horizontal style-form']) }}
                <div class="form-group">
                    <h3><i class="fa fa-angle-right"></i> Confirmation </h3>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Do this you want to alert your UC about the issues in the team? </label>
                    <div class="col-sm-8">
                        <div class="checkbox checkbox-inline">
                            <label>
                                <input type="radio" name="alert" id="option-alert" value="true"> Yes </input>
                            </label>
                            <label>
                                <input type="radio" name="alert" id="option-alert" value="false"> No </input>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Confirm submission? </label>
                    <div class="col-sm-8">
                        <div class="checkbox checkbox-inline">
                            <label>
                                <input type="radio" name="confirm" id="option-confirmed" value="true"> Yes </input>
                            </label>
                            <label>
                                <input type="radio" name="confirm" id="option-confirmed" value="false"> No </input>
                            </label>
                        </div>
                    </div>
                </div>

                <div align="center" >
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
                {{ Form::close() }}
            </div>
        </div><!-- col-lg-12-->
    </div>
@endsection