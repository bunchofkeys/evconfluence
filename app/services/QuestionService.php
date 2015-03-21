<?php
class QuestionService
{
    public static function find($questionId)
    {
        return QuestionModel::find($questionId);
    }

    public static function getList($formId, $type = null)
    {
        if (is_null($type)) {
            return QuestionModel::whereHas('section', function ($q) use ($formId, $type) {
                $q->where('form_id', $formId);
            })->orderBy('type')->orderBy('question_number')->get();
        } else {
            return QuestionModel::where('type', $type)->whereHas('section', function ($q) use ($formId, $type) {
                $q->where('form_id', $formId);
                $q->where('type', $type);
            })->orderBy('question_number')->get();
        }
    }

    public static function getAnswer($submissionId, $questionId, $targetStudentId)
    {
        return AnswerModel::where('submission_id', $submissionId)
            ->where('question_id', $questionId)
            ->where('target_student_id', $targetStudentId)->first();
    }

    public static function getAllAnswer($submissionId)
    {
        return AnswerModel::where('submission_id', $submissionId);
    }

    public static function setSubmission($formId, $selfId, $input)
    {
        $submission = SubmissionService::find($formId, $selfId);
        $submission->status = 'Submitted';
        if($input['alert'] == 'true')
        {
            $submission->alert = true;
            EmailService::sendUcAlertEmail($submission);
        }
        else
        {
            $submission->alert = false;
        }
        $submission->submission_date_time = date("Y-m-d H:i:s");
        $submission->save();
    }

    public static function storeAnswer($input, $form, $questions, $self, $target)
    {
        $submission = SubmissionModel::where('form_id',$form->form_id)
            ->where('student_id', $self->student_id)->first();

        if(is_null($submission))
        {
            $submission = new SubmissionModel();
            $submission->form_id = $form->form_id;
            $submission->student_id = $self->student_id;
            $submission->alert = false;
            $submission->status = 'draft';
            $submission->save();
        }

        foreach($questions as $question)
        {
            $answer = AnswerModel::where('submission_id', $submission->submission_id)
                ->where('question_id', $question->question_id)
                ->where('target_student_id', $target->student_id)->first();

            if (is_null($answer))
            {
                $answer = new AnswerModel();
                $answer->submission_id = $submission->submission_id;
                $answer->question_id = $question->question_id;
                $answer->target_student_id = $target->student_id;
            }
            $answer->input = $input['question-' . $question->question_id];
            $answer->save();
        }
    }

    public static function createQuestion($input, $periodId, $formId, $type)
    {
        $question = new QuestionModel();
        $question->question_text = $input['question_text'];
        $question->format = $input['question_format'];
        $question->type = $type;

        $query = SectionModel::where('form_id', $formId)
            ->whereHas('question', function($q) use ($type)
            {
                $q->where('type', $type);
            })
            ->with('question')
            ->get()
            ->max('question', 'question_number');

        if(is_null($query))
        {
            $question->question_number = 1;
        }
        else
        {
            $question->question_number = intval($query->question_number) + 1;
        }
        $question->save();

        $section = new SectionModel();
        $section->question_id = $question->question_id;
        $section->form_id = $formId;
        $section->save();
    }

    public static function editQuestion($input, $questionId)
    {
        $question = self::find($questionId);
        $question->question_text = $input['question_text'];
        $question->format = $input['question_format'];
        $question->save();
    }

    public static function deleteQuestion($questionId)
    {
        $question = self::find($questionId);
        $question->delete();
    }

}