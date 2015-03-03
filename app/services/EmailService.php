<?php

class EmailService
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

    public static function sendReminderMail()
    {
        $formList = FormModel::all();

        foreach($formList as $form)
        {
            if($form->status == 'Ready')
            {
                $students = $form->period->students;
                foreach ($students as $student)
                {
                    $link = TokenService::generateLink($student->person_id, 'evaluation', $form->start_date_time, $form->end_date_time);

                    $email = $student->person->email;
                    $subject = 'Test Mail';
                    $emailTemplate = 'emails.reminder';

                    $data = ['user' => $student,
                        'link' => $link];

                    self::sendEmail($email, $subject, $emailTemplate, $data);
                }
            }
        }
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

        $url = TokenService::generateLink($user->person_id, "setpassword", $startDateTime, $endDateTime);
        $data = ['user' => $user,
            'url' => $url];

        self::sendEmail($email,$subject,$emailTemplate,$data);
    }

}