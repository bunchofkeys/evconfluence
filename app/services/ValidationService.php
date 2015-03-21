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
            'first_name' 	    =>  'required',
            'last_name'		    =>  'required',
            'school'            =>  'required',
            'unit_required_for' =>  'required',
        ];
        return self::validate($input);
    }

    public static function validateAdminEdit($input)
    {
        self::$rules =
            [
                'first_name' 	    =>  'required',
                'last_name'		    =>  'required',
            ];
        return self::validate($input);
    }

    public static function validatePassword($input)
    {
        self::$rules =
            [
                'password'          =>  'required',
                'confirm_password'  =>  'required|same:password',
            ];
        return self::validate($input);
    }

    public static function validateTeacherCreate($input)
    {
        self::$rules =
            [
                'first_name' 	    =>  'required',
                'last_name'		    =>  'required',
                'school'            =>  'required',
                'unit_required_for' =>  'required',
                'email'		        =>  'required|unique:person,email|email',
                'password'          =>  'required',
                'confirm_password'  =>  'required|same:password',
            ];
        return self::validate($input);
    }

    public static function validateAdminCreate($input)
    {
        self::$rules =
            [
                'first_name' 	    =>  'required',
                'last_name'		    =>  'required',
                'email'		        =>  'required|unique:person,email|email',
                'password'          =>  'required',
                'confirm_password'  =>  'required|same:password',
            ];
        return self::validate($input);
    }

    public static function validateRegistration($input)
    {
        self::$rules =
        [
            'first_name' 	    =>  'required',
            'last_name'		    =>  'required',
            'email'		        =>  'required|unique:person,email|email',
            'school'            =>  'required',
            'unit_required_for' =>  'required',
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

    public static function validateStudent($input)
    {
        self::$rules =
            [
                'student_id'        =>  'required',
                'team_id'		    =>  'required',
                'email'		        =>  'required|email',
                'first_name' 	    =>  'required',
                'last_name'		    =>  'required',
            ];
        return self::validate($input);
    }


    public static function validateConfig($input)
    {
        $configs = ConfigModel::all();
        $result = true;
        foreach($configs as $config)
        {
            self::$rules =
                [
                    $config->key        =>  'required',
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
                    $question->question_text    =>  'required',
                ];

            $temp =  self::validate($input,false);
            if($temp == false)
            {
                $errorMessage = array_merge($errorMessage, [$question->question_text =>'Please enter ' . $question->question_text]);
            }
            $result = $result && self::validate($input,false);
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
                'alert'        =>  'required',
                'confirmation'        =>  'required',
            ];
        return self::validate($input);
    }

    public static function validateQuestion($input)
    {
        self::$rules =
            [
                'question_text'        =>  'required',
            ];
        return self::validate($input);
    }

    public static function validateForm($input)
    {
        $input['end_date_time'] = trim($input['end_date_time'], ' ');
        self::$rules =
            [
                'name'       =>  'required',
                'end_date_time'         =>  'required|date_format:d.m.Y H:i',
            ];
        return self::validate($input);
    }

    public static function validateResetPassword($input)
    {
        self::$rules =
            [
                'email'		        =>  'required|email',
            ];
        return self::validate($input);
    }

    public static function validateCsvRow($input)
    {
        self::$rules =
            [
                'person id'         =>  'required',
                'email'		        =>  'required|email',
                'surname'           =>  'required',
                'title'             =>  'required',
                'given name'        =>  'required',
                'teach period'      =>  'required',
                'unit code'         =>  'required',
                'team id'           =>  'required',

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