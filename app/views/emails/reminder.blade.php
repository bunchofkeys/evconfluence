
<p> Dear {{ $person->first_name }} {{ $person->last_name }},</p>
<p> This is a reminder email. You have to complete your evaluation by {{$endDate}}. Please follow the link below to do your evaluation. </p>
<p> {{Request::root() . '/token/' . $link->token . '/' . $link->action}} </p>