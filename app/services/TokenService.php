<?php

class TokenService{
    public static function generateLink(User $user, $action, DateTime $startDateTime, DateTime $endDateTime)
    {
        $id = $user->person_id;

        $link = new TemporaryLink();
        $link->fill([
            'person_id' => $id,
            'action' => $action,
            'startDateTime' => $startDateTime,
            'endDateTime' => $endDateTime,
            'active' => true,
            'token' => md5(uniqid(rand(), true))
        ]);
        $link->save();

        return 'http://' . $_SERVER['HTTP_HOST'] . '/token/' . $link->token . '/' . $link->action;
    }
}