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
        Session::flash('errorMessage', $message);
        Session::flash('alert-class', 'alert-danger');
    }

    public static function has($string)
    {
        $message = Session::get('errorMessage');

        if(is_object($message))
        {
            if($message->has($string))
            {
                return true;
            }
        }
        elseif(is_array($message))
        {
            if(array_key_exists($string,$message))
            {
                return true;
            }
        }
        return false;
    }
}
