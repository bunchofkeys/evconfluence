<?php

class TokenController extends \BaseController {

	public function setPassword($token)
	{
		$link = TokenService::find($token);
		$person = PersonService::find($link->person_id);
		return View::make('token.setpassword')->with(['person' => $person]);

	}

	public function storePassword($token)
	{
		$link = TokenService::find($token);

		$person = PersonService::find($link->person_id);
		$user = UserService::find($person->user->user_id);
		$user->password = Hash::make(Input::get('password'));
		$user->save();

		$link->active = false;
		$link->save();

		MessageService::alert('Your password has been set successfully');
		return Redirect::route('session.login');

	}

	public function evaluation($token)
	{
		$link = TokenService::find($token);
		$person = PersonService::find($link->person_id);
		if (!is_null($person))
		{
			$student = $person->student;
			$forms = FormService::getRelatedForms($student);
			foreach ($forms as $form)
			{
				$submission = SubmissionService::find($form->form_id, $student->student_id);
				if(!is_null($submission))
				{
					$form->submission_status = $submission->status;
				}
				else
				{
					$form->submission_status = 'Not submitted';
				}

			}
			return View::make('token.evaluation.index')->with(['forms' => $forms,'token' => $token, 'student' => $student]);
		}

	}

	public function evaluationBegin($token, $formId, $selfId)
	{
		$student = StudentService::find($selfId);
		$form = FormService::find($formId);
		return View::make('token.evaluation.begin')->with(['form' => $form,'token' => $token, 'student' => $student]);
	}

	public function evaluationStoreConfirm($token, $formId, $selfId)
	{
		if(ValidationService::validateSubmission(Input::all()))
		{
			QuestionService::setSubmission($formId, $selfId, Input::all());
			return Redirect::route('token.evaluation.index', ['token' => $token]);
		}
		else
		{
			return Redirect::back()->withInput();
		}
	}

	public function evaluationConfirm($token, $formId, $selfId)
	{
		$form = FormService::find($formId);
		$self = StudentService::find($selfId);
		$team = $self->team($form->period_id);
		$peerList = StudentService::getListByTeam($form->period_id, $team->team_id, $self->student_id);

		return View::make('token.evaluation.confirm')
			->with('token', $token)
			->with('form', $form)
			->with('peerList', $peerList)
			->with('self',$self);

	}

	public function evaluationForm($token, $formId, $selfId, $targetId)
	{
		$form = FormService::find($formId);
		$self = StudentService::find($selfId);

		if($selfId == $targetId)
		{
			$type = 'self';
			$target = $self;
		}
		else
		{
			$type = 'peer';
			$target = StudentService::find($targetId);
		}

		$questions = QuestionService::getList($formId, $type);
		$submission = SubmissionService::find($formId, $selfId);

		if(!is_null($submission))
		{
			foreach ($questions as $question)
			{
				$answer = QuestionService::getAnswer($submission->submission_id, $question->question_id, $target->student_id);
				if(!is_null($answer))
				{
					$question->answer = $answer->input;
				}
			}
		}
		$team = $self->team($form->period_id);
		$peerList = StudentService::getListByTeam($form->period_id, $team->team_id, $self->student_id);

		return View::make('token.evaluation.form')
			->with('token', $token)
			->with('form', $form)
			->with('questions', $questions)
			->with('self',$self)
			->with('target', $target)
			->with('peerList', $peerList)
			->with('title', ucwords($type) . ' Evaluation: ' . $target->person->first_name . ' ' . $target->person->last_name);


	}

	public function evaluationStore($token, $formId, $selfId, $targetId)
	{
		$form = FormService::find($formId);
		$self = StudentService::find($selfId);
		$team = $self->team($form->period_id);
		$peerList = StudentService::getListByTeam($form->period_id, $team->team_id, $self->student_id);
		$output = null;

		if($selfId == $targetId)
		{
			$type = 'self';
			$target = $self;
			$nextTargetId = $peerList->first()->student_id;
		}
		else
		{
			$target = StudentService::find($targetId);
			$lastIndex = array_search($target, $peerList->all());
			if($lastIndex < $peerList->count()-1)
			{
				$nextTargetId = $peerList[$lastIndex + 1]->student_id;
			}
			else
			{
				$output = Redirect::route('token.evaluation.confirm', ['token' => $token, 'formId' => $formId, 'selfId' => $selfId]);
			}
			$type = 'peer';
		}
		$questions = QuestionService::getList($formId,$type);
		if(ValidationService::validateEvaluationForm(Input::all(), $questions))
		{
			QuestionService::storeAnswer(Input::all(), $form, $questions, $self, $target);
			if (is_null($output))
			{
				$output = Redirect::route('token.evaluation.form', ['token' => $token,
					'selfId' => $selfId,
					'formId' => $formId,
					'targetId' => $nextTargetId])->with('lastId', $targetId);
			}
		}
		else
		{
			return Redirect::back()->withInput();
		}
		return $output;
	}
}
