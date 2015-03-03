<?php

class StudentService
{
    public static function find($student_id)
    {
        return Student::where('student_id', $student_id)->first();
    }

    public static function findNext($periodId, $team_id, $exclude_id, $target_id = 0)
    {
        return Student::whereHas('teams', function($q) use ($periodId, $team_id, $exclude_id, $target_id)
        {
            $q->where('period_id', $periodId);
            $q->where('team_id', $team_id);
            $q->where('student_id', '!=', $exclude_id);
            $q->where('student_id', '!=>', $target_id);
        })->first();
    }

    public static function getList($period)
    {
        return Student::whereHas('teams', function($q) use ($period)
        {
            $q->where('period_id', $period);
        })->get();
    }

    public static function getListByTeam($periodId, $team_id, $exclude_id = '')
    {
        return Student::whereHas('teams', function($q) use ($periodId, $team_id, $exclude_id)
        {
            $q->where('period_id', $periodId);
            $q->where('team_id', $team_id);
            $q->where('student_id', '!=', $exclude_id);
        })->orderBy('student_id', 'desc')->get();
    }

    public static function createStudent($input, $periodId)
    {
        try {
            $student = StudentService::find($input['student_id']);
            $person = PersonService::findByEmail($input['email']);

            if (is_null($person)) {
                $person = new Person();
                $person->first_name = $input['first_name'];
                $person->last_name = $input['last_name'];
                $person->email = $input['email'];
                $person->save();
            }

            if (is_null($student))
            {
                $student = new Student();
                $student->person_id = $person->person_id;
                $student->student_id = $input['student_id'];
                $student->save();
            }

            $team = new Team();
            $team->period_id = $periodId;
            $team->student_id = $student->student_id;
            $team->team_id = $input['team_id'];
            $team->save();
        }
        catch(mysqli_sql_exception $ex)
        {
            return false;
        }
        return true;
    }
}