@if(Session::has('messages'))
    <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissable"> {{ Session::get('messages') }} </div>
@endif

@if(Session::has('errorMessage'))
    <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissable">
        {{Session::get('errorMessage')}}
        {{--@foreach(Session::get('errors')->all() as $key=>$value)--}}
            {{--<li> {{ $value }} </li>--}}
        {{--@endforeach--}}
    </div>
@endif
