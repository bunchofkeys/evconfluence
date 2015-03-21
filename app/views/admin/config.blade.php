@extends('layout.master.inner_two')

@section('sidebar')
    @include('layout.partial.admin.side_menu')
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="form-panel">
            {{ Form::open(['class' => 'form-horizontal style-form']) }}
            <h2 class="mb">Configurations</h2>


            <table class="table">
                <thead>
                <tr>
                    <th class="col-lg-2">Key</th>
                    <th class="col-lg-3">Description</th>
                    <th class="col-lg-7">Value</th>
                </tr>
                </thead>
                <tbody>
                @foreach($configs as $config)
                <tr>
                    <td>{{$config->key}}</td>
                    <td>{{$config->description}}</td>
                    <td><input type="text"  name="{{$config->key}}" class="form-control"
                               @if(MessageService::has($config->key))value="{{Input::old($config->key)}}" style="border-color:red" @else value="{{$config->value}}"@endif>

                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>
            <div align="center" >
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection