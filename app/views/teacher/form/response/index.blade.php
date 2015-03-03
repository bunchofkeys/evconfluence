@extends('layout.master.inner_two')

@section('sidebar')
    @include('layout.partial.teacher.side_menu')
@endsection

@section('content')
    <div class="row mt">
        <div class="col-md-12" style="padding-bottom: 20px">
            <a href="{{ URL::route('teacher.period.index') }}" class="btn btn-primary">Back</a>
        </div>
        <div class="col-md-12">
            <div class="content-panel showback">
                <h4>Responses</h4><hr><table class="table table-striped table-advance table-hover">
                    <thead>
                    <tr>
                        <th class="col-md-1">Student ID</th>
                        <th class="col-md-1">Student Name</th>
                        <th class="col-md-2">Status</th>
                        <th class="col-md-2">Submission date time</th>
                        <th class="col-md-2">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($submissions as $submission)
                        <tr>
                            <td>{{ $submission->student_id }}</td>
                            <td>{{ $submission->student->person->first_name }} {{ $submission->student->person->last_name }}</td>
                            <td>{{ $submission->status }} </td>
                            <td>{{ $submission->submission_date_time }} </td>
                            <td>
                                <a href="{{URL::route('teacher.form.response.student', ['period' => $periodId, 'form' => $formId, 'studentId' => $submission->student_id ]) }}" class="btn btn-primary btn-xs"><span class="label label-primary">View Submission</span></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
    </div>
@endsection

