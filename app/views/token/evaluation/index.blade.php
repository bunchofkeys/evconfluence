@extends('layout.master.home')

@section('content')
    <div class="row mt">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="content-panel showback">
                <h4>Forms</h4><hr><table class="table table-striped table-advance table-hover">
                    <thead>
                    <tr>
                        <th class="col-md-1">Unit Code</th>
                        <th class="col-md-1">Status</th>
                        <th class="col-md-2">Closing Date</th>
                        <th class="col-md-2">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($forms as $form)
                        <tr>
                            <td>{{ $form->period->unit_code }}</td>
                            <td>{{ $form->submission_status }}</td>
                            <td>{{ $form->end_date_time }} </td>
                            <td>
                                @if($form->submission_status != 'Submitted' )
                                    <a href="{{URL::route('token.evaluation.form', ['token' => $token,
                                                                            'selfId' => $student->student_id,
                                                                            'formId' => $form->form_id,
                                                                            'targetId' => $student->student_id]) }}"
                                       class="btn btn-primary btn-xs"><span class="label label-primary">Start</span></a>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
    </div>
@endsection