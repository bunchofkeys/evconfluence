@if(Session::has('messages'))
    <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissable"> {{ Session::get('messages') }} </div>
@endif

@if(Session::has('errorMessage'))
    <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissable">
        @if(is_object(Session::get('errorMessage')))
            @foreach(Session::get('errorMessage')->all() as $key=>$value)
                <li> {{ $value }} </li>
            @endforeach
        @else
            {{Session::get('errorMessage')}}
        @endif
    </div>
@endif
