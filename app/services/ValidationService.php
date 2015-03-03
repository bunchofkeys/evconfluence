<?php

class ValidationService
{
    protected static $rules;
    protected static $messages =
    [
        'required'  =>  'Please enter your :attribute.',
        'unique'    =>  'The :attribute entered already exist.',
        'email'     =>  'Please enter a valid :attribute',
        'same'      =>  'The :others must match'
    ];

    public static function validateTeacherEdit($input)
    {
        Self::$rules =
        [
            'first_name' 	    =>  'required',
            'last_name'		    =>  'required',
            'school'            =>  'required',
            'unit_required_for' =>  'required',
        ];
        return Self::validate($input);
    }

    public static function validateAdminEdit($input)
    {
        Self::$rules =
            [
                'first_name' 	    =>  'required',
                'last_name'		    =>  'required',
            ];
        return Self::validate($input);
    }

    public static function validatePassword($input)
    {
        Self::$rules =
            [
                'password'          =>  'required',
                'confirm_password'  =>  'required|same:password',
            ];
        return Self::validate($input);
    }

    public static function validateTeacherCreate($input)
    {
        Self::$rules =
            [
                'first_name' 	    =>  'required',
                'last_name'		    =>  'required',
                'school'            =>  'required',
                'unit_required_for' =>  'required',
                'email'		        =>  'required|unique:person,email|email',
                'password'          =>  'required',
                'confirm_password'  =>  'required|same:password',
            ];
        return Self::validate($input);
    }

    public static function validateAdminCreate($input)
    {
        Self::$rules =
            [
                'first_name' 	    =>  'required',
                'last_name'		    =>  'required',
                'email'		        =>  'required|unique:person,email|email',
                'password'          =>  'required',
                'confirm_password'  =>  'required|same:password',
            ];
        return Self::validate($input);
    }

    public static function validateRegistration($input)
    {
        Self::$rules =
        [
            'first_name' 	    =>  'required',
            'last_name'		    =>  'required',
            'email'		        =>  'required|unique:person,email|email',
            'school'            =>  'required',
            'unit_required_for' =>  'required',
        ];
        return Self::validate($input);
    }

    public static function validatePeriod($input)
    {
        Self::$rules =
            [
                'semester_code' =>  'required',
                'year'		    =>  'required',
                'unit_code'     =>  'required',
            ];
        return Self::validate($input);
    }

    public static function validateStudent($input)
    {
        Self::$rules =
            [
                'student_id'        =>  'required',
                'team_id'		    =>  'required',
                'email'		        =>  'required|email',
                'first_name' 	    =>  'required',
                'last_name'		    =>  'required',
            ];
        return Self::validate($input);
    }

    public static function validateQuestion($input)
    {
        Self::$rules =
            [
                'question_text'        =>  'required',
            ];
        return Self::validate($input);
    }

    public static function validateForm($input)
    {
        Self::$rules =
            [
                'start_date_time'       =>  'required',
                'end_date_time'         =>  'required',
            ];
        return Self::validate($input);
    }

    private static function validate($input)
    {
        $validator = Validator::make($input, Self::$rules, Self::$messages);
        if ($validator->fails())
        {
            MessageService::error($validator->messages());
            return false;
        }
        else
        {
            return true;
        }
    }
}