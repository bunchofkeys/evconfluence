@extends('layout.master.home')

@section('content')
    <h1>Create a new user</h1>
    <div>
        {{ Form::open(['route' => 'user.storeRegister']) }}

        @foreach($form as $key => $value)

            {{ Form::label($key, $value . ': ') }}
            {{ Form::text($key) }}
            </br>
        @endforeach

        </br>
            {{ Form::submit('Submit') }}
        {{ Form::close() }}
    </div>
@stop

