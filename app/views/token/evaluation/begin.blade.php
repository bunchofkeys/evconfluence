@extends('layout.master.home')

@section('content')
    <div class="row mt">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="content-panel showback">
                <h1>Student & Peer Evaluation</h1>
                <hr>
                <h3>Introduction</h3>
                <p>
                    You will see a series of questions and scales designed to allow you to evaluate both your own performance in the project process to date, and that of each of your fellow group members.

                    This form, together with those of others in your group, will determine the first Self and Peer Evaluation (SPE) mark that you get.

                </p>
                <p><b>Please note:</b> Everything that you put into this form will be kept strictly confidential by the unit coordinator.</p>

                    <h3>Using the assessment scales</h3>

                    <p>The scales are from 1 to 5.  Assess these as:</p>

                <p>1 = Very poor, or even obstructive, contribution to the project process</p>
                <p>2 = Poor contribution to the project process</p>
                <p>3 = acceptable contribution to the project process</p>
                <p>4 = good contribution to the project process</p>
                <p> 5 = excellent contribution to the project process</p>


                  <h3>The assessment criteria</h3>

                <p>   You need to fill in a mark from the scale for each one of 5 performance criteria.  These are:</p>

                <p>    1.	The amount of work and effort put into the Requirements and Analysis Document, the Project Management Plan, and the Design Document.</p>
                <p>    2.	Willingness to work as part of the group and taking responsibility in the group.</p>
                <p>    3.	Communication within the group and participation in group meetings.</p>
                <p>    4.	Contribution to the management of the project, e.g. work delivered on time.</p>
                <p>    5.	Problem solving and creativity on behalf of the group’s work.</p>

                <div class="btn-group">
                    <a href="{{URL::route('token.evaluation.index', ['token' => $token]) }}"
                       class="btn btn-success btn-lg">Back</a>
                    <a href="{{URL::route('token.evaluation.form', ['token' => $token,
                                                                            'selfId' => $student->student_id,
                                                                            'formId' => $form->form_id,
                                                                            'targetId' => $student->student_id]) }}"
                       class="btn btn-success btn-lg">Begin</a>
                </div>
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
    </div>
@endsection