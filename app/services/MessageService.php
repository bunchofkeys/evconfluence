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

    public static function error($message)
    {
        Session::flash('errors', $message);
        Session::flash('alert-class', 'alert-danger');
    }
}
