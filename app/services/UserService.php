<?php

class UserService {

    public static $errors;
    public static $message;

    public static function createUser($input)
    {
        $person = new Person();
        $teacher = new Teacher();
        $user = new User();

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

    public static function registerTeacher($input)
    {
        $person = new Person();
        $teacher = new Teacher();
        $user = new User();

        // create user
        $person->first_name = $input['first_name'];
        $person->last_name = $input['last_name'];
        $person->email = $input['email'];
        if($person->save() == false)
        {
            MessageService::error($person->getErrors());
            return false;
        }

        $user->username = $input['email'];
        $user->password = Hash::make(uniqid());
        $user->status = 'Pending';
        $user->role = 'Teacher';
        $user->person_id = $person->person_id;
        if($user->save() == false)
        {
            MessageService::error($user->getErrors());
            $person->delete();
            return false;
        }

        $teacher->user_id = $user->user_id;
        $teacher->school = $input['school'];
        $teacher->unit_required_for = $input['unit_required_for'];
        if($teacher->save() == false)
        {
            MessageService::error($teacher->getErrors());
            $user->delete();
            $person->delete();
            return false;
        }

        return $user;

    }

    public static function deleteUser($user)
    {
        try
        {
            self::$message = $user->username;
            $user->person->delete();
            return true;
        }
        catch(mysqli_sql_exception $ex)
        {
            self::$errors = $ex;
            return false;
        }


    }

    public static function find($id)
    {
        return UserModel::where('user_id', '=', $id)->first();
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
        return UserModel::where('status', '=', 'Pending')->get();
    }

    public static function approvedUserList()
    {
        if(Auth::user() != null)
        {
            $id = Auth::user()->user_id;
            return UserModel::where('user_id', '!=', $id)->where('status', '=', 'Approved')->get();
        }
        else
        {
            return null;
        }
    }
};