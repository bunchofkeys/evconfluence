@extends('layout.master.inner_two')

@section('sidebar')
    @include('layout.partial.teacher.side_menu')
@endsection

@section('content')
    <div class="row mt">

        <div class="col-md-12" style="padding-bottom: 20px">
            <a href="{{ Url::route('teacher.period.create') }}" class="btn btn-primary">New Teaching Period</a>
            <a href="{{ Url::route('teacher.period.uploadList') }}" class="btn btn-primary">Upload Csv</a>
        </div>
        <div class="col-md-12">
            <div class="content-panel showback">
                <h4>Teaching Period</h4><hr><table class="table table-striped table-advance table-hover">
                    <thead>
                    <tr>
                        <th class="col-md-1">Semester Code</th>
                        <th class="col-md-1">Year</th>
                        <th class="col-md-2">Unit Code</th>
                        <th class="col-md-2">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($periodList as $period)
                        <tr>
                            <td>{{ $period->semester_code }}</td>
                            <td>{{ $period->year }}</td>
                            <td>{{ $period->unit_code }} </td>
                            <td>
                                <a href="{{URL::route('teacher.student.index', ['period' => $period->period_id]) }}" class="btn btn-primary btn-xs"><span class="label label-primary">Manage Students</span></a>
                                <a href="{{URL::route('teacher.form.index', ['period' => $period->period_id]) }}" class="btn btn-primary btn-xs"><span class="label label-primary">Manage Forms</span></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
    </div>
@endsection

