<?php

class PersonService
{
    public static $errors;

    public static function find($id)
    {
        return Person::where('person_id', $id)->first();
    }
}