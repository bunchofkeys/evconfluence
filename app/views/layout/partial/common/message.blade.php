@if(Session::has('messages'))
    <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissable"> {{ Session::get('messages') }} </div>
@endif
