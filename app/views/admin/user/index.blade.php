@extends('layout.master.inner_two')

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
        @if(count($pendingUsers) > 0)
        <div class="col-md-12">
            <div class="content-panel showback">
                <h4><i class="fa fa-angle-right"></i> Pending Users</h4><hr><table class="table table-striped table-advance table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pendingUsers as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->first_name }} </td>
                            <td>{{ $user->last_name }} </td>
                            <td>{{ $user->role }} </td>
                            <td>
                                <a href="{{URL::route('admin.user.edit', ['user' => $user->id]) }}" class="btn btn-primary btn-xs"><span class="label label-primary">Edit</span></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
        @else
        <div class="col-md-12">
            <div class="content-panel showback">
                <h4><i class="fa fa-angle-right"></i> Pending Users</h4><hr>
                <table class="table table-striped table-advance table-hover">
                    <p> No Pending users </p>
                </table>
            </div>
        </div>
        @endif
        <div class="col-md-12">
            <div class="content-panel">
                <h4><i class="fa fa-angle-right"></i> Active Users</h4><hr><table class="table table-striped table-advance table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->first_name }} </td>
                        <td>{{ $user->last_name }} </td>
                        <td>{{ $user->role }} </td>
                        <td>
                            <a href="{{URL::route('admin.user.edit', ['user' => $user->id]) }}" class="btn btn-primary btn-xs"><span class="label label-primary">Edit</span></a>
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
    </div>
@endsection