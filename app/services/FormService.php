<?php
class FormService
{
    public static function find($formId)
    {
        return FormModel::where('form_id', $formId)->first();
    }

    public static function getList($period)
    {
        return FormModel::where('period_id', $period)->get();
    }

    public static function createForm($input, $period)
    {
        $form = new FormModel();
        $form->name = $input['name'];
        $form->end_date_time = DateTime::createFromFormat('d.m.Y H:i', $input['end_date_time']);
        if(array_key_exists('status', $input))
        {
            $form->status = $input['status'];
        }
        else
        {
            $form->status = 'Not Started';
        }
        $form->period_id = $period;
        $form->save();
    }

    public static function editForm($input, $formId)
    {
        $form = FormModel::find($formId);
        $form->name = $input['name'];
        $date = trim($input['end_date_time'], ' ');
        $form->end_date_time = DateTime::createFromFormat('d.m.Y H:i', $date);
        if(array_key_exists('status', $input))
        {
            $form->status = $input['status'];
        }
        else
        {
            $form->status = 'Not Started';
        }
        $form->save();
    }

    public static function deleteForm($formId)
    {
        $form = FormModel::find($formId);
        $form->delete();
    }


    public static function getRelatedForms($student)
    {
        $periods = $student->period;
        $list = [];

        foreach ($periods as $period) {
            array_push($list, $period->period_id);
        }

        return FormModel::whereIn('period_id', $list)->with('period')->get();
    }

    public static function toStartEvaluation($form)
    {
        if($form->status == "Not Started")
        {
            $now = (new DateTime())->format('Y-m-d H:i:s');
            $datediff = $now - $form->end_date_time;

            $config = ConfigModel::where('key', 'SPE_DURATION_DAY')->first();
            if(!is_null($config))
            {
                $num = intval($config->value);
            }
            else
            {
                $num = 7;
            }

            if(floor($datediff/(60*60*24)) <= $num)
            {
                return true;
            }
        }
        return false;
    }

    public static function toStartReminder($form)
    {
        if($form->status == "Started")
        {
            $now = (new DateTime())->format('Y-m-d H:i:s');
            $datediff = $now - $form->end_date_time;

            $config = ConfigModel::where('key', 'SPE_REMINDER_HOUR')->first();
            if(!is_null($config))
            {
                $num = intval($config->value);
            }
            else
            {
                $num = 24;
            }

            if(floor($datediff/(60*60)) <= $num)
            {
                return true;
            }
        }
        return false;
    }
}