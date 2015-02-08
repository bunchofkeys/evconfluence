<?php

class StudentRepository
{
    public static function getList($period)
    {
        return Student::whereHas('team', function($q) use ($period)
        {
            $q->where('period_id', $period);
        })->get();
    }

}