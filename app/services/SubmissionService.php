<?php
class SubmissionService
{
    public static function find($formId, $studentId)
    {
        return SubmissionModel::where('form_id', $formId)->where('student_id', $studentId)->first();
    }

    public static function getList($formId)
    {
        $submissions = SubmissionModel::where('form_id', $formId)->with('student')->get();

        foreach($submissions as $submission)
        {
            $submission->student->person = $submission->student->person;
        }
        return $submissions;
    }

}