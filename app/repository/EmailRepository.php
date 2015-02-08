<?php

class EmailRepository
{
    private static $email;

    private static function sendEmail($emailTo, $subject, $viewTemplate, array $data)
    {
        self::$email = ['emailTo' => $emailTo,
            'subject' => $subject,
            'message' => $data
        ];

        Mail::send($viewTemplate, $data, function($message)
        {
            $message->to(self::$email['emailTo'])->subject(self::$email['subject']);
        });
    }

    public static function sendRegistrationNotification($user)
    {
        $adminList = User::where('status', 'Approved')->where('role', 'Admin')->get();

         $url = URL::route('admin.user.approval', ['id' => $user->user_id]);
        foreach($adminList as $admin)
        {
            $email = $admin->person->email;
            $subject = 'New SPE applicant';
            $emailTemplate = 'emails.newApplicant';

            $data = ['user' => $admin,
            'url' => $url];

            self::sendEmail($email, $subject, $emailTemplate, $data);
        }
    }

    public static function sendRejectEmail($user)
    {
        $email = $user->person->email;
        $subject = 'SPE account application unsuccessful';
        $emailTemplate = 'emails.reject';

        $data = ['user' => $user];

        self::sendEmail($email,$subject,$emailTemplate,$data);
    }

    public static function sendConfirmationEmail($user)
    {
        $email = $user->person->email;
        $subject = 'SPE account creation approved!';
        $emailTemplate = 'emails.approval';

        $startDateTime = new DateTime();
        $endDateTime = new DateTime();
        $endDateTime->modify('+3 day');

        $url = self::generateLink($user, "setPassword", $startDateTime, $endDateTime);
        $data = ['user' => $user,
            'url' => $url];

        self::sendEmail($email,$subject,$emailTemplate,$data);
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
