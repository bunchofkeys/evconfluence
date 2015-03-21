<?php

class ValidationService
{
    protected static $rules;
    protected static $messages =
    [
        'required'  =>  'You have to enter a value for :attribute.',
        'unique'    =>  'The :attribute entered already exist.',
        'email'     =>  'Please enter a valid :attribute',
        'same'      =>  'The :others must match'
    ];

    public static function validateTeacherEdit($input)
    {
        self::$rules =
        [
            'first_name' 	    =>  'required|max:100',
            'last_name'		    =>  'required|max:100',
            'school'            =>  'required|max:100',
            'unit_required_for' =>  'required|max:100',
        ];
        return self::validate($input);
    }

    public static function validateAdminEdit($input)
    {
        self::$rules =
            [
                'first_name' 	    =>  'required|max:100',
                'last_name'		    =>  'required|max:100',
            ];
        return self::validate($input);
    }

    public static function validatePassword($input)
    {
        self::$rules =
            [
                'password'          =>  'required|max:100',
                'confirm_password'  =>  'required|same:password|max:100',
            ];
        return self::validate($input);
    }

    public static function validateTeacherCreate($input)
    {
        self::$rules =
            [
                'first_name' 	    =>  'required|max:100',
                'last_name'		    =>  'required|max:100',
                'school'            =>  'required|max:100',
                'unit_required_for' =>  'required|max:100',
                'email'		        =>  'required|unique:person,email|email|max:100',
                'password'          =>  'required|max:100',
                'confirm_password'  =>  'required|same:password|max:100',
            ];
        return self::validate($input);
    }

    public static function validateAdminCreate($input)
    {
        self::$rules =
            [
                'first_name' 	    =>  'required|max:100',
                'last_name'		    =>  'required|max:100',
                'email'		        =>  'required|unique:person,email|email|max:100',
                'password'          =>  'required|max:100',
                'confirm_password'  =>  'required|same:password|max:100',
            ];
        return self::validate($input);
    }

    public static function validateRegistration($input)
    {
        self::$rules =
        [
            'first_name' 	    =>  'required|max:100',
            'last_name'		    =>  'required|max:100',
            'email'		        =>  'required|unique:person,email|email|max:100',
            'school'            =>  'required|max:100',
            'unit_required_for' =>  'required|max:100',
        ];
        return self::validate($input);
    }

    public static function validatePeriod($input)
    {
        self::$rules =
            [
                'semester_code' =>  'required|max:4',
                'year'		    =>  'required|integer',
                'unit_code'     =>  'required|max:6',
            ];
        return self::validate($input);
    }

    public static function validateStudent($input, $period)
    {
        self::$rules =
            [
                'student_id'        =>  'required|max:10',
                'team_id'		    =>  'required|max:10',
                'email'		        =>  'required|email|max:100',
                'first_name' 	    =>  'required|max:100',
                'last_name'		    =>  'required|max:100',
            ];
        $result = self::validate($input);
        if($result == true)
        {
            $exist = TeamModel::where(['student_id' => $input['student_id'], 'period_id' => $period->period_id])->first();
            if(!is_null($exist))
            {
                MessageService::error(['student_id' => 'Student already exist in this period']);
                return false;
            }
            $person = PersonService::findByEmail($input['email']);
            if(!is_null($person))
            {
                $student = StudentModel::where('person_id', $person->person_id)->first();
                if(!is_null($student))
                {
                    if($student->student_id != $input['student_id'])
                    {
                        MessageService::error(['email' => 'Email already exist with another student id']);
                        return false;
                    }
                }
            }
        }
        return $result;
    }


    public static function validateConfig($input)
    {
        $configs = ConfigModel::all();
        $result = true;
        foreach($configs as $config)
        {
            self::$rules =
                [
                    $config->key        =>  'required|max:200',
                ];
            $result = $result && self::validate($input);
        }
        return $result;
    }

    public static function validateEvaluationForm($input, $questions)
    {
        $result = true;
        $errorMessage = [];
        foreach($questions as $question)
        {
            self::$rules =
                [
                    $question->question_text    =>  'required|max:255',
                ];

            $temp =  self::validate($input,false);
            if($temp == false)
            {
                $errorMessage = array_merge($errorMessage, [$question->question_text =>'Please enter ' . $question->question_text]);
            }
            $result = $result && $temp;
        }

        if(!empty($errorMessage))
        {
            MessageService::error($errorMessage);
        }
        return $result;
    }

    public static function validateSubmission($input)
    {
        self::$rules =
            [
                'alert'        =>  'required|max:1',
                'confirmation'        =>  'required',
            ];
        return self::validate($input);
    }

    public static function validateQuestion($input)
    {
        self::$rules =
            [
                'question_text'        =>  'required|max:255',
            ];
        return self::validate($input);
    }

    public static function validateForm($input)
    {
        $input['end_date_time'] = trim($input['end_date_time'], ' ');
        self::$rules =
            [
                'name'       =>  'required|max:45',
                'defaultQuestion' => 'required',
                'end_date_time'         =>  'required|date_format:d.m.Y H:i',
            ];
        return self::validate($input);
    }

    public static function validateResetPassword($input)
    {
        self::$rules =
            [
                'email'		        =>  'required|email|max:100',
            ];
        return self::validate($input);
    }

    public static function validateCsvRow($input)
    {
        self::$rules =
            [
                'person id'         =>  'required|max:10',
                'email'		        =>  'required|email|max:100',
                'surname'           =>  'required|max:100',
                'title'             =>  'required|max:5',
                'given name'        =>  'required|max:100',
                'teach period'      =>  'required|max:9',
                'unit code'         =>  'required|max:6',
                'team id'           =>  'required|max:6',

            ];
        return self::validate($input, false);
    }

    private static function validate($input, $showMessage = true)
    {
        $validator = Validator::make($input, self::$rules, self::$messages);
        if ($validator->fails())
        {
            if($showMessage == true)
            {
                MessageService::error($validator->messages());
            }
            return false;
        }
        else
        {
            return true;
        }
    }
}