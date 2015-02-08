<?php
class QuestionService
{
    public static function getList($form_id, $type)
    {
        return QuestionModel::where('type', $type)->whereHas('section', function($q) use ($form_id)
        {
            $q->where('form_id', $form_id);
        })->get()->sortBy('question_number');
    }

    public static function createQuestion($input, $period_id, $form_id, $type)
    {
        $question = new QuestionModel();
        $question->question_text = $input['question_text'];
        $question->format = $input['question_format'];
        $question->type = $type;

        $query = SectionModel::where('form_id', $form_id)
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
        $section->form_id = $form_id;
        $section->save();
    }
}