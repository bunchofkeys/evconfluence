<?php

class TokenService
{
    public static function find($tokenId)
    {
        return TemporaryLinkModel::where('token', $tokenId)->first();
    }

    public static function generateLink($personId, $action, $startDateTime, $endDateTime)
    {
        $link = new TemporaryLinkModel();
        $link->fill([
            'person_id' => $personId,
            'action' => $action,
            'startDateTime' => $startDateTime,
            'endDateTime' => $endDateTime,
            'active' => true,
            'token' => md5(uniqid(rand(), true)),
        ]);
        $link->save();

        return Request::root() . '/token/' . $link->token . '/' . $link->action;
    }
}