<?php

class UserRepository {

    public static $errors;
    public static $message;

    public static function createUser($input)
    {
        $person = new Person();
        $teacher = new Teacher();
        $user = new User();

        //validation
        if(Self::validateUser($input) == false)
        {
            return false;
        }
        else
        {
            // create user
            $person->first_name = $input['first_name'];
            $person->last_name = $input['last_name'];
            $person->email = $input['email'];
            $person->save();

            $user->username = $input['email'];
            $user->password = Hash::make($input['password']);
            $user->status = 'Approved';
            $user->role = $input['role'];
            $user->person_id = $person->person_id;
            $user->save();

            if($user->role == 'Teacher')
            {
                $teacher->user_id = $user->user_id;
                $teacher->school = $input['school'];
                $teacher->unit_required_for = $input['unit_required_for'];
                $teacher->save();
            }
            return true;
        }
    }

    public static function registerTeacher($input)
    {
        $person = new Person();
        $teacher = new Teacher();
        $user = new User();

        //validation
        if(Self::validateUser($input) == false)
        {
            return false;
        }
        else
        {
            // create user
            $person->first_name = $input['first_name'];
            $person->last_name = $input['last_name'];
            $person->email = $input['email'];
            $person->save();

            $user->username = $input['email'];
            $user->password = Hash::make(uniqid());
            $user->status = 'Pending';
            $user->role = 'Teacher';
            $user->person_id = $person->person_id;
            $user->save();

            $teacher->user_id = $user->user_id;
            $teacher->school = $input['school'];
            $teacher->unit_required_for = $input['unit_required_for'];
            $teacher->save();

            return true;
        }
    }

    public static function deleteUser($user)
    {
        try
        {
            Self::$message = $user->username;
            $user->person->delete();
            return true;
        }
        catch(mysqli_sql_exception $ex)
        {
            Self::$errors = $ex;
            return false;
        }


    }

    public static function find($id)
    {
        return User::where('user_id', '=', $id)->first();
    }

    public static function updateUser($user, $input)
    {
        try
        {
            $user->fill($input);
            $user->person->fill($input);
            if(array_key_exists('password', $input))
            {
                $password = $input['password'];
                $confirmPassword = $input['confirm_password'];
                if ($password == $confirmPassword)
                {
                    $user->password = Hash::make($password);
                }
            }
            $user->save();
            return true;
        }
        catch (mysqli_sql_exception $ex)
        {
            return false;
        }
    }
    public static function pendingUserList()
    {
        return User::where('status', '=', 'Pending')->get();
    }

    public static function approvedUserList()
    {
        if(Auth::user() != null)
        {
            $id = Auth::user()->user_id;
            return User::where('user_id', '!=', $id)->where('status', '=', 'Approved')->get();
        }
        else
        {
            return null;
        }
    }

    private static function validateUser($input)
    {
        return true;
    }

    public static function authenticateUser($username, $password)
    {

    }

};