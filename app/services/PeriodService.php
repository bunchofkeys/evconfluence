<?php

class PeriodService
{
    public static function find($id)
    {
        return Teaching_Period::find($id);
    }


    public static function getList($user)
    {
        return Teaching_Period::where('user_id',$user->user_id)->get();
    }
    public static function createPeriod($input, $user)
    {
        $period = new Teaching_Period();

        $period->fill($input);
        $period->user_id = $user->user_id;
        $period->save();
        return true;
    }

    public static function uploadList($file)
    {
        $top = array_map('strtolower', str_getcsv($file->current()));
        $user = Auth::user();

        try {
            foreach ($file as $key => $value) {
                if ($key != '0' && $value != null) {
                    $row = array_combine($top, str_getcsv($value));

                    $period = Teaching_Period::where('period_id', $row['teach period'])->first();
                    if ($period == null) {
                        $period = new Teaching_Period();

                        $teachPeriod = explode(' ', $row['teach period']);
                        $period->semester_code = $teachPeriod[0];
                        $period->year = $teachPeriod[1];
                        $period->user_id = $user->user_id;
                        $period->unit_code = $row['unit code'];
                        $period->save();
                    }

                    $student = StudentModel::where('student_id', $row['person id'])->first();
                    if ($student == null) {
                        $person = PersonModel::where('email', $row['email'])->first();
                        if ($person == null) {
                            $person = new Person();
                            $person->first_name = $row['given name'];
                            $person->last_name = $row['surname'];
                            $person->title = $row['title'];
                            $person->email = $row['email'];
                            $person->save();
                        }

                        $student = new Student();
                        $student->student_id = $row['person id'];
                        $student->person_id = $person->person_id;
                        $student->save();
                    }

                    $team = TeamModel::where('period_id', $row['teach period'])->where('student_id', $row['person id'])->first();
                    if ($team == null) {
                        $team = new Team();
                        $team->student_id = $row['person id'];
                        $team->period_id = $period->period_id;
                        $team->team_id = $row['team id'];
                        $team->save();
                    }
                }
            }
        }
        catch(mysqli_sql_exception $ex)
        {
            return false;
        }
        return true;
    }

};