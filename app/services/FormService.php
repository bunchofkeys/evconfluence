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
        $form->start_date_time = DateTime::createFromFormat('d.m.Y H:i', $input['start_date_time']);
        $form->end_date_time = DateTime::createFromFormat('d.m.Y H:i', $input['end_date_time']);
        if(array_key_exists('status', $input))
        {
            $form->status = $input['status'];
        }
        else
        {
            $form->status = 'off';
        }
        $form->period_id = $period;
        $form->save();
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
}