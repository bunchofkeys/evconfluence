@extends('layout.master.inner_two')

@section('sidebar')
    @include('layout.partial.teacher.side_menu')
@endsection

@section('content')
    <div class="row mt">
        @if(empty($messages) == false)
            @foreach($messages as $key => $value)
                <div class="alert alert-{{$key}} alert-dismissable"> {{$value}} </div>
            @endforeach
        @endif
        <div class="col-md-12" style="padding-bottom: 20px">
            <a href="{{ Url::route('teacher.semester.create') }}" class="btn btn-primary">New Teaching Semester</a>
        </div>
        <div class="col-md-12">
            <div class="content-panel showback">
                <h4>Semester</h4><hr><table class="table table-striped table-advance table-hover">
                    <thead>
                    <tr>
                        <th class="col-md-1">ID</th>
                        <th class="col-md-4">Year</th>
                        <th class="col-md-2">Semester</th>
                        <th class="col-md-2">Unit Code</th>
                        <th class="col-md-2">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--@foreach($users as $user)--}}
                        {{--<tr>--}}
                            {{--<td>{{ $user->user_id }}</td>--}}
                            {{--<td>{{ $user->username }}</td>--}}
                            {{--<td>{{ $user->person->first_name }}</td>--}}
                            {{--<td>{{ $user->person->last_name }}</td>--}}
                            {{--<td>{{ $user->role }} </td>--}}
                            {{--<td>--}}
                                {{--<a href="{{URL::route('admin.user.edit', ['user' => $user->user_id]) }}" class="btn btn-primary btn-xs"><span class="label label-primary">Edit</span></a>--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                    {{--@endforeach--}}
                    </tbody>
                </table>
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
    </div>
@endsection

