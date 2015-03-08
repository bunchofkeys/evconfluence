<?php

class PersonService
{
    public static function find($id)
    {
        return PersonModel::where('person_id', $id)->first();
    }

    public static function findByEmail($email)
    {
        return PersonModel::where('email', $email)->first();
    }
}