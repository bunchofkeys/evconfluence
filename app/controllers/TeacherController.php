<?php

class TeacherController extends \BaseController {

	public function index()
	{
		$user = Auth::user();
		return View::make('teacher.index')->with(['user' => $user]);
	}

	public function periodIndex()
	{
		$periodList = PeriodService::getList(Auth::user());
		return View::make('teacher.period.index')->with('periodList', $periodList);
	}

	public function periodCreate()
	{
		return View::make('teacher.period.create');
	}

	public function storePeriodCreate()
	{
		$result = PeriodService::createPeriod(Input::all(), Auth::user());

		if($result == true)
		{
			MessageService::alert('A new period has been created successfully.');
			return Redirect::route('teacher.period.index');
		}
		else
		{
			MessageService::error();
			return Redirect::route('teacher.period.index');
		}
	}

	public function studentIndex($period_id)
	{
		$studentList = StudentService::getList($period_id);
		return View::make('teacher.student.index')->with('studentList', $studentList);
	}

	public function uploadList()
	{
		return View::make('teacher.period.uploadList');
	}

	public function storeUploadList()
	{

		// check for csv extension
		if(!Input::hasFile('file'))
		{
			MessageService::alert('No file selected', 'danger');
			return Redirect::route('teacher.period.uploadList');
		}
		if(Input::file('file')->getClientOriginalExtension() == 'csv')
		{
			$file = Input::file('file')->openFile();
			if(PeriodService::uploadList($file) == true)
			{
				MessageService::alert('File uploaded successfully.');
				return Redirect::route('teacher.period.index');
			}
			else
			{
				MessageService::error();
				return Redirect::route('teacher.period.index');
			}

		}
		MessageService::alert('Invalid Extension', 'danger');
		return Redirect::route('teacher.period.uploadList');
	}

	public function formIndex($period_id)
	{
		$formList = FormService::getList($period_id);
		return View::make('teacher.form.index')->with(['formList' => $formList, 'period' => $period_id]);
	}

	public function formCreate($period_id)
	{
		return View::make('teacher.form.create')->with('period', $period_id);
	}

	public function storeFormCreate($period_id)
	{
		FormService::createForm(Input::all(), $period_id);
		return Redirect::route('teacher.form.index', ['period' => $period_id]);
	}

	public function formQuestion($period_id, $form_id, $type)
	{
		$questionList = QuestionService::getList($form_id, $type);
		return View::make('teacher.form.question.index')->with(['questionList' => $questionList, 'type' => $type, 'period' => $period_id, 'form' => $form_id]);
	}

	public function formQuestionCreate($period_id, $form_id, $type)
	{
		return View::make('teacher.form.question.create')->with(['type' => $type, 'period' => $period_id, 'form' => $form_id]);
	}

	public function formQuestionStoreCreate($period_id, $form_id, $type)
	{
		QuestionService::createQuestion(Input::all(), $period_id, $form_id, $type);
		return Redirect::route('teacher.form.question',['type' => $type, 'period' => $period_id, 'form' => $form_id]);
	}
}
