@extends('layout.master.inner_two')

@section('content')
    <div class="showback">
        <h1> Welcome</h1>
        <p>
            {{$email->email}}
        </p>
    </div>

@endsection