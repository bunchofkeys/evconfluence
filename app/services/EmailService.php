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

    public static function sendStudentMail()
    {
        $formList = FormModel::all();

        foreach($formList as $form)
        {
            if(FormService::toStartEvaluation($form))
            {
                $students = $form->period->students;
                foreach ($students as $student)
                {
                    $now = (new DateTime())->format('Y-m-d H:i:s');
                    $link = TokenService::generateLink($student->person_id, 'evaluation', $now, $form->end_date_time);

                    $email = $student->person->email;
                    $subject = 'Start of ' . $form->name;
                    $emailTemplate = 'emails.startEvaluation';

                    $data = ['person' => $student->person,
                        'endDate' => $form->end_date_time,
                        'url' => $link];

                    self::sendEmail($email, $subject, $emailTemplate, $data);
                }
                $form->status = 'Started';
                $form->save();
            }
            elseif (FormService::toStartReminder($form))
            {
                $students = $form->period->students;
                foreach ($students as $student)
                {
                    $submission = SubmissionService::find($form->form_id, $student->student_id);

                    if(!is_null($submission))
                    {
                        if ($submission->status != 'Submitted')
                        {
                            self::sendSubmissionMail($student, $form);
                        }
                    }
                    else
                    {
                        self::sendSubmissionMail($student, $form);
                    }
                }
                $form->status = 'Sent Reminder';
                $form->save();
            }
        }
    }

    private static function sendSubmissionMail($student, $form)
    {
        $now = (new DateTime())->format('Y-m-d H:i:s');
        $link = TemporaryLinkModel::where(['person_id' => $student->person_id, 'action' => 'evaluation'])->first();
        if (is_null($link))
        {
            $link = TokenService::generateLink($student->person_id, 'evaluation', $now, $form->end_date_time);
        }
        else
        {
            $link = TokenService::generateLink($student->person_id, 'evaluation', $link->startDateTime, $form->end_date_time);
        }

        $email = $student->person->email;
        $subject = 'Reminder: Your ' . $form->name . ' evaluation is ending';
        $emailTemplate = 'emails.reminder';

        $data = ['person' => $student->person,
            'endDate' => $form->end_date_time,
            'url' => $link];

        self::sendEmail($email, $subject, $emailTemplate, $data);
    }
    public static function sendRegistrationNotification($user)
    {
        $adminList = UserModel::where('status', 'Approved')->where('role', 'Admin')->get();

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

    public static function sendResetPasswordEmail($user)
    {

        $email = $user->person->email;
        $subject = 'Password recovery email';
        $emailTemplate = 'emails.forgetpassword';

        $startDateTime = new DateTime();
        $endDateTime = new DateTime();
        $endDateTime->modify('+1 day');

        $url = TokenService::generateLink($user->person_id, "setpassword", $startDateTime, $endDateTime);
        $data = ['user' => $user,
            'url' => $url];

        self::sendEmail($email,$subject,$emailTemplate,$data);
    }

    public static function sendUcAlertEmail($submission)
    {
        $student = StudentService::find($submission->student_id);
        $form = FormService::find($submission->form_id);
        $period = PeriodService::find($form->period_id);
        $teacher = UserService::find($period->user_id);

        $url = URL::route('teacher.form.response.student', ['form' => $form->form_id, 'studentId' => $submission->student_id, 'period' => $period->period_id]);

        $email = $teacher->person->email;
        $subject = 'Student submission requires your attention';
        $emailTemplate = 'emails.teacherAlert';

        $data = ['teacher' => $teacher,
            'student' => $student,
            'url' => $url];

        self::sendEmail($email,$subject,$emailTemplate,$data);
    }
}
