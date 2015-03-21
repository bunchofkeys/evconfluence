<?php

class PeriodService
{
    public static function find($id)
    {
        return TeachingPeriodModel::find($id);
    }


    public static function getList($user)
    {
        return TeachingPeriodModel::where('user_id',$user->user_id)->get();
    }

    public static function createPeriod($input, $user)
    {
        $period = new TeachingPeriodModel();

        $period->fill($input);
        $period->user_id = $user->user_id;
        $period->save();
        return true;
    }

    public static function deletePeriod($periodId)
    {
        $period = self::find($periodId);
        $period->delete();
    }

    public static function editPeriod($input, $periodId)
    {
        $period = self::find($periodId);

        $period->semester_code = $input['semester_code'];
        $period->year = $input['year'];
        $period->unit_code = $input['unit_code'];
        $period->save();
    }

    public static function uploadList($file)
    {
        $top = array_map('strtolower', str_getcsv($file->current()));
        $user = Auth::user();
        $errorMessage = [];
        try
        {
            foreach ($file as $key => $value)
            {
                if ($key != '0' && $value != null)
                {
                    $row = array_combine($top, str_getcsv($value));

                    if(ValidationService::validateCsvRow($row) == false)
                    {
                        $periodString = explode(" ",$row['teach period']);
                        $period = TeachingPeriodModel::where(['semester_code' => $periodString['0'], 'year' => $periodString['1']])->first();
                        if ($period == null)
                        {
                            $period = new TeachingPeriodModel();

                            $teachPeriod = explode(' ', $row['teach period']);
                            $period->semester_code = $teachPeriod[0];
                            $period->year = $teachPeriod[1];
                            $period->user_id = $user->user_id;
                            $period->unit_code = $row['unit code'];
                            $period->save();
                        }

                        $student = StudentModel::where('student_id', $row['person id'])->first();
                        if ($student == null)
                        {
                            $person = PersonModel::where('email', $row['email'])->first();
                            if ($person == null)
                            {
                                $person = new PersonModel();
                                $person->first_name = $row['given name'];
                                $person->last_name = $row['surname'];
                                $person->title = $row['title'];
                                $person->email = $row['email'];
                                $person->save();
                            }

                            $student = new StudentModel();
                            $student->student_id = $row['person id'];
                            $student->person_id = $person->person_id;
                            $student->save();
                        }

                        $team = TeamModel::where('period_id', $period->period_id)->where('student_id', $row['person id'])->first();
                        if ($team == null)
                        {
                            $team = new TeamModel();
                            $team->student_id = $row['person id'];
                            $team->period_id = $period->period_id;
                            $team->team_id = $row['team id'];
                            $team->save();
                        }
                    }
                    else
                    {
                        array_push($errorMessage, '- Row ' . $key . ' does not contain the correct data format.');
                    }
                }
            }
            if(!empty($errorMessage))
            {
                array_unshift($errorMessage, 'File uploaded, but with errors. Please check data');
                MessageService::alert($errorMessage, 'warning');
            }
            else
            {
                MessageService::alert('File uploaded successfully.');
            }
        }
        catch(mysqli_sql_exception $ex)
        {
            MessageService::error('An error has occured');
            return false;
        }
        return true;
    }

};