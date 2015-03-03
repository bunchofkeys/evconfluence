@extends('layout.master.inner_two')

@section('sidebar')
    @include('layout.partial.teacher.side_menu')
@endsection

@section('content')
    <div class="row mt">
        <div class="col-md-12" style="padding-bottom: 20px">
            <a href="{{ Url::route('teacher.student.create', ['period' => $period]) }}" class="btn btn-primary">Add Student</a>
            <a href="{{ URL::route('teacher.period.index') }}" class="btn btn-primary">Back</a>
        </div>
        <div class="col-md-12">
            <div class="content-panel showback">
                <h4>Student</h4><hr><table class="table table-striped table-advance table-hover">
                    <thead>
                    <tr>
                        <th class="col-md-1">Student ID</th>
                        <th class="col-md-4">Team ID</th>
                        <th class="col-md-2">Email</th>
                        <th class="col-md-2">First Name</th>
                        <th class="col-md-2">Last Name</th>
                        <th class="col-md-2">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($studentList as $student)
                        <tr>
                            <td>{{ $student->student_id }}</td>
                            <td>{{ $student->team($period)->team_id }}</td>
                            <td>{{ $student->person->email }}</td>
                            <td>{{ $student->person->first_name }}</td>
                            <td>{{ $student->person->last_name }}</td>

                            <td>
                                {{--<a href="{{URL::route('teacher.student.index', ['period' => $period->period_id]) }}" class="btn btn-primary btn-xs"><span class="label label-primary">Manage Students</span></a>--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
    </div>
@endsection

