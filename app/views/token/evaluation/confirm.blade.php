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
                <div class="form-group @if(MessageService::has('alert UC')) has-error @endif">
                    <label class="col-sm-4 control-label">Do this you want to alert your UC about the issues in the team? </label>
                    <div class="col-sm-8">
                        <div class="checkbox checkbox-inline">
                            <label>
                                <input type="radio" name="alert" id="option-alert" value="true"
                                @if(Input::old('alert') == 'true') checked="checked" @endif>
                                Yes </input>
                            </label>
                            <label>
                                <input type="radio" name="alert" id="option-alert" value="false"
                                @if(Input::old('alert') == 'false') checked="checked" @endif>
                                No </input>
                            </label>
                            <label>
                                <a data-toggle="modal" href="#Modal"><i class="fa fa-question-circle fa-2x"></i></a>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group @if(MessageService::has('alert UC')) has-error @endif">
                    <label class="col-sm-4 control-label">Confirm submission? </label>
                    <div class="col-sm-8">
                        <div class="checkbox checkbox-inline" style="padding-left: 60px">
                            <input type="checkbox" name="confirmation" id="option-confirmed"
                            @if(Input::old('confirmation') == 'true') value="true" @endif> </input>
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

    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="Modal" role="dialog" tabindex="-1" id="Modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="ds">
                    <h3>Alert your Unit Coordinator </h3>
                </div>
                <div class="panel-body">
                    <div class="task-content">

                        <ul class="task-list">
                            <li>
                                <span class="task-title-sp">If there are any incidences that may cause concern and you wish to alert the Unit Coordinator of potential trouble in the team, please select "Yes".
                                </span>
                            </li>
                            <li>
                                <span class="task-title-sp">Otherwise, select "No". </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <br/>
            </div>
        </div>
    </div>
    </div>
@endsection