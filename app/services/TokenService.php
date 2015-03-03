<?php

class TokenService
{
    public static function generateLink($personId, $action, $startDateTime, $endDateTime)
    {
        $link = new TemporaryLink();
        $link->fill([
            'person_id' => $personId,
            'action' => $action,
            'startDateTime' => $startDateTime,
            'endDateTime' => $endDateTime,
            'active' => true,
            'token' => md5(uniqid(rand(), true)),
        ]);
        $link->save();

        return 'http://' . Request::root() . '/token/' . $link->token . '/' . $link->action;

    }
}