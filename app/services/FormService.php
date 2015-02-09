<?php
class FormService
{
    public static function getList($period)
    {
        return FormModel::where('period_id', $period)->get();
    }

    public static function createForm($input, $period)
    {
        $form = new FormModel();
        $form->start_date_time = DateTime::createFromFormat('d.m.Y H:i', $input['start_date_time']);
        $form->end_date_time = DateTime::createFromFormat('d.m.Y H:i', $input['end_date_time']);
        if(array_key_exists('status', $input))
        {
            $form->status = $input['status'];
        }
        else
        {
            return 'off';
            $form->status = 'off';
        }
        $form->period_id = $period;
        $form->save();
        return $form;
    }
}