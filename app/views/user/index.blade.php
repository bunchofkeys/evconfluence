@extends('layout.master.home')

@section('content')
    <h1>Listing of all users</h1>
    <div>
        @foreach($user as $u)
            <li>
                {{$u->Email}}
            </li>
            <li>
                {{$u->Status}}
            </li>

        @endforeach
    </div>
@stop

