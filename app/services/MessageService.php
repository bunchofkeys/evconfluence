<?php

class MessageService
{
    public static function alert($message, $type = 'success')
    {
        Session::flash('messages', $message);
        if($type == 'success') {
            Session::flash('alert-class', 'alert-success');
        }
        else
        {
            Session::flash('alert-class', 'alert-' . $type);
        }
    }

    public static function error()
    {
        Session::flash('messages', 'An error has occurred.');
        Session::flash('alert-class', 'alert-danger');
    }
}
