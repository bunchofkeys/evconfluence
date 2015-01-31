<?php

class EmailRepository
{
    private static $email;

    private static function sendEmail($emailTo, $subject, $viewTemplate, array $data)
    {
        Self::$email = ['emailTo' => $emailTo,
                        'subject' => $subject,
                        'message' => $data
        ];

        Mail::send($viewTemplate, $data, function($message)
        {
            $message->to(Self::$email['emailTo'])->subject(Self::$email['subject']);
        });
    }

    public static function sendRejectEmail($user)
    {
        $email = $user->person->email;
        $subject = 'SPE account application unsuccessful';
        $emailTemplate = 'emails.reject';

        $data = ['user' => $user];

        Self::sendEmail($email,$subject,$emailTemplate,$data);
    }

    public static function sendConfirmationEmail($user)
    {
        $email = $user->person->email;
        $subject = 'SPE account creation approved!';
        $emailTemplate = 'emails.approval';

        $startDateTime = new DateTime();
        $endDateTime = new DateTime();
        $endDateTime->modify('+3 day');

        $url = Self::generateLink($user, "setpassword", $startDateTime, $endDateTime);
        $data = ['user' => $user,
                'url' => $url];

        Self::sendEmail($email,$subject,$emailTemplate,$data);
    }

    private static function generateLink(User $user, $action, DateTime $startDateTime, DateTime $endDateTime)
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
