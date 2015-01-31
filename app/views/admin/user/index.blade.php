@extends('layout.master.inner_two')

@section('sidebar')
    @include('layout.partial.admin.side_menu')
@endsection

@section('content')
    <div class="row mt">
        @if(empty($messages) == false)
            @foreach($messages as $key => $value)
                <div class="alert alert-{{$key}} alert-dismissable"> {{$value}} </div>
            @endforeach
        @endif
        <div class="col-md-12" style="padding-bottom: 20px">
            <a href="{{ URL::route('admin.user.create') }}" class="btn btn-primary">Create User</a>
        </div>
        <div class="col-md-12">
            <div class="content-panel showback">
                <h4>Pending Users</h4><hr>
                @if(count($pendingUsers) > 0)
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                        <tr>
                            <th class="col-md-1">ID</th>
                            <th class="col-md-4">Username</th>
                            <th class="col-md-2">First Name</th>
                            <th class="col-md-2">Last Name</th>
                            <th class="col-md-2">Role</th>
                            <th class="col-md-1">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pendingUsers as $user)
                            <tr>
                                <td>{{ $user->user_id }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->person->first_name }}</td>
                                <td>{{ $user->person->last_name }}</td>
                                <td>{{ $user->role }} </td>
                                <td>
                                    <a href="{{URL::route('admin.user.approval', ['user' => $user->user_id]) }}" class="btn btn-primary btn-xs"><span class="label label-primary">View</span></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                @else
                    <table class="table table-striped table-advance table-hover">
                        <p>There are no users pending for approval. </p>
                    </table>

                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="content-panel showback">
                <h4>Approved Users</h4><hr><table class="table table-striped table-advance table-hover">
                    <thead>
                    <tr>
                        <th class="col-md-1">ID</th>
                        <th class="col-md-4">Username</th>
                        <th class="col-md-2">First Name</th>
                        <th class="col-md-2">Last Name</th>
                        <th class="col-md-2">Role</th>
                        <th class="col-md-1">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->user_id }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->person->first_name }}</td>
                            <td>{{ $user->person->last_name }}</td>
                            <td>{{ $user->role }} </td>
                            <td>
                                <a href="{{URL::route('admin.user.edit', ['user' => $user->user_id]) }}" class="btn btn-primary btn-xs"><span class="label label-primary">Edit</span></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
    </div>
@endsection