<?php

class TokenService
{
    public static function find($tokenId)
    {
        return TemporaryLinkModel::where('token', $tokenId)->first();
    }

    public static function generateLink($personId, $action, $startDateTime, $endDateTime)
    {
        // find existing link for person
        $link = TemporaryLinkModel::where(['person_id' => $personId, 'action' => $action])->first();

        // generate unique token
        $uniqueToken = md5(uniqid(rand(), true));
        while(TemporaryLinkModel::where('token', $uniqueToken)->count() > 0)
        {
            $uniqueToken = md5(uniqid(rand(), true));
        }

        // check if link already exist. if exist, overrides with new token
        if(is_null($link))
        {
            $link = new TemporaryLinkModel();
            $link->fill([
                'person_id' => $personId,
                'action' => $action,
                'startDateTime' => $startDateTime,
                'endDateTime' => $endDateTime,
                'active' => true,
                'token' => $uniqueToken,
            ]);
            $link->save();

            return URL::to('/') . '/token/' . $link->token . '/' . $link->action;
        }
        else
        {
            $link->startDateTime = $startDateTime;
            $link->endDateTime = $endDateTime;
            $link->active = '1';
            $link->save();
            return URL::to('/') . '/token/' . $link->token . '/' . $link->action;
        }
    }

}