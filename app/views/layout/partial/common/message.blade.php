@if(Session::has('errorMessage'))
    <div class="alert alert-danger alert-dismissable">
        @if(is_object(Session::get('errorMessage')))
            @foreach(Session::get('errorMessage')->all() as $key=>$value)
                <p> {{ $value }} </p>
            @endforeach
        @elseif(is_array(Session::get('errorMessage')))
            @foreach(Session::get('errorMessage') as $key=>$value)
                <p> {{ $value }} </p>
            @endforeach
        @else
            {{Session::get('errorMessage')}}
        @endif
    </div>
@endif

@if(Session::has('messages'))
    <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissable">
        @if(is_array(Session::get('messages')))
            @foreach(Session::get('messages') as $key=>$value)
                <p> {{ $value }} </p>
            @endforeach
        @else
            {{ Session::get('messages') }}
        @endif
    </div>
@endif