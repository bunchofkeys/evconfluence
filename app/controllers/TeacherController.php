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
		if(ValidationService::validatePeriod(Input::all()) != false)
		{
			$result = PeriodService::createPeriod(Input::all(), Auth::user());
			MessageService::alert('A new period has been created successfully.');
			return Redirect::route('teacher.period.index');
		}
		else
		{
			return Redirect::back()->withInput();
		}
	}

	public function periodEdit($periodId)
	{
		$period = PeriodService::find($periodId);
		return View::make('teacher.period.edit')->with('period', $period);
	}

	public function storePeriodEdit($periodId)
	{
		if(Input::has('delete'))
		{
			PeriodService::deletePeriod($periodId);
			MessageService::alert('Period deleted successfully.');
			return Redirect::route('teacher.period.index');
		}
		elseif(ValidationService::validatePeriod(Input::all()) != false && Input::has('save'))
		{
			PeriodService::editPeriod(Input::all(), $periodId);
			MessageService::alert('Period saved successfully.');
			return Redirect::route('teacher.period.index');
		}
		else
		{
			return Redirect::back()->withInput();
		}
	}


	public function studentIndex($periodId)
	{
		$studentList = StudentService::getList($periodId);
		return View::make('teacher.student.index')->with('studentList', $studentList)->with('period', $periodId);
	}

	public function studentCreate($periodId)
	{
		return View::make('teacher.student.create')->with('period', $periodId);
	}

	public function storeStudentCreate($periodId)
	{
		if(ValidationService::validateStudent(Input::all()) != false)
		{
			$result = StudentService::createStudent(Input::all(), $periodId);
			MessageService::alert('A new student has been created successfully.');
			return Redirect::route('teacher.student.index', ['period' => $periodId]);
		}
		else
		{
			return Redirect::back()->withInput();
		}
	}

	public function studentEdit($periodId, $studentId)
	{
		$student = StudentService::find($studentId);
		return View::make('teacher.student.edit')->with(['period' => $periodId, 'student' => $student]);
	}

	public function storeStudentEdit($periodId, $studentId)
	{
		$input = Input::all();
		$input['student_id'] = $studentId;

		if(Input::has('delete'))
		{
			StudentService::deleteStudent($studentId);
			MessageService::alert('Student delete successfully');
			return Redirect::route('teacher.student.index', ['period' => $periodId]);
		}
		elseif(ValidationService::validateStudent($input) != false && Input::has('save'))
		{
			StudentService::editStudent(Input::all(), $periodId, $studentId);
			MessageService::alert('Student saved successfully');
			return Redirect::route('teacher.student.index', ['period' => $periodId]);
		}
		else
		{
			return Redirect::back()->withInput();
		}
	}

	public function uploadList()
	{
		return View::make('teacher.period.uploadList');
	}

	public function storeUploadList()
	{
		// check for csv extension
		if (!Input::hasFile('file'))
		{
			MessageService::error('No file selected');
			return Redirect::route('teacher.period.uploadList');
		}
		if (Input::file('file')->getClientOriginalExtension() == 'csv') {
			$file = Input::file('file')->openFile();

			if (PeriodService::uploadList($file) == true) {
				return Redirect::route('teacher.period.index');
			} else
			{
				return Redirect::route('teacher.period.index');
			}

		}
		else
		{
			MessageService::error('Invalid Extension');
		}
		return Redirect::route('teacher.period.uploadList');
	}

	public function formIndex($periodId)
	{
		$formList = FormService::getList($periodId);
		return View::make('teacher.form.index')->with(['formList' => $formList, 'period' => $periodId]);
	}

	public function formCreate($periodId)
	{
		return View::make('teacher.form.create')->with('period', $periodId);
	}

	public function storeFormCreate($periodId)
	{
		if(ValidationService::validateForm(Input::all()) != false)
		{
			FormService::createForm(Input::all(), $periodId);
			MessageService::alert('A new form has been created successfully.');
			return Redirect::route('teacher.form.index', ['period' => $periodId]);
		}
		return Redirect::back()->withInput();
	}

	public function formEdit($periodId, $formId)
	{
		$form = FormService::find($formId);
		$period = PeriodService::find($periodId);
		return View::make('teacher.form.edit')->with(['period' => $period, 'form' => $form]);
	}

	public function storeFormEdit($periodId, $formId)
	{
		if(Input::has('delete'))
		{
			FormService::deleteForm($formId);
			MessageService::alert('Form deleted successfully.');
			return Redirect::route('teacher.form.index', ['period' => $periodId]);
		}
		elseif(ValidationService::validateForm(Input::all()) != false && Input::has('save'))
		{
			FormService::editForm(Input::all(), $formId);
			MessageService::alert('Form saved successfully.');
			return Redirect::route('teacher.form.index', ['period' => $periodId]);
		}
		else
		return Redirect::back()->withInput();
	}

	public function formQuestion($periodId, $formId, $type)
	{
		$questionList = QuestionService::getList($formId, $type);
		return View::make('teacher.form.question.index')->with(['questionList' => $questionList, 'type' => $type, 'period' => $periodId, 'form' => $formId]);
	}

	public function formQuestionCreate($periodId, $formId, $type)
	{
		return View::make('teacher.form.question.create')->with(['type' => $type, 'period' => $periodId, 'form' => $formId]);
	}

	public function formQuestionStoreCreate($periodId, $formId, $type)
	{
		if(ValidationService::validateQuestion(Input::all()) != false)
		{
			QuestionService::createQuestion(Input::all(), $periodId, $formId, $type);
			MessageService::alert('A new question has been created successfully.');
			return Redirect::route('teacher.form.question',['type' => $type, 'period' => $periodId, 'form' => $formId]);
		}
		else
		{
			return Redirect::back()->withInput();
		}
	}

	public function formQuestionEdit($periodId, $formId, $type, $questionId)
	{
		$question = QuestionService::find($questionId);
		return View::make('teacher.form.question.edit')->with(['type' => $type, 'period' => $periodId, 'form' => $formId, 'question' => $question]);
	}

	public function formQuestionStoreEdit($periodId, $formId, $type, $questionId)
	{
		if(Input::has('delete'))
		{
			QuestionService::deleteQuestion($questionId);
			MessageService::alert('Question deleted successfully.');
			return Redirect::route('teacher.form.question',['type' => $type, 'period' => $periodId, 'form' => $formId]);
		}
		elseif(ValidationService::validateQuestion(Input::all()) != false)
		{
			QuestionService::editQuestion(Input::all(), $questionId);
			MessageService::alert('Question saved successfully.');
			return Redirect::route('teacher.form.question',['type' => $type, 'period' => $periodId, 'form' => $formId]);
		}
		else
		{
			return Redirect::back()->withInput();
		}
	}

	public function formResponse($periodId, $formId)
	{
		$submisisons = SubmissionService::getList($formId);
		return View::make('teacher.form.response.index')->with(['submissions' => $submisisons, 'periodId' => $periodId, 'formId' => $formId]);
	}

	public function formResponseStudent($periodId, $formId, $studentId)
	{
		$submission = SubmissionService::find($formId, $studentId);
		if(!is_null($submission))
		{
			$questions = ['self' => QuestionService::getList($formId, 'self'), 'peer' => QuestionService::getList($formId, 'peer')];
			$student = $submission->student;
			$student->person = $student->person;
			$team = $student->team($periodId);
			$peerList = StudentService::getListByTeam($periodId, $team->team_id, $studentId);

			$student->question = new stdClass();

			foreach ($questions['self'] as $question) {
				$questionId = $question->question_id;
				$student->question->$questionId = $question;
				$student->question->$questionId->answer = QuestionService::getAnswer($submission->submission_id, $questionId, $studentId);
			}

			foreach ($peerList as $peer) {
				$peer->question = new stdClass();
				foreach ($questions['peer'] as $question) {
					$questionId = $question->question_id;
					$peer->question->$questionId = $question;
					$peer->question->$questionId->answer = QuestionService::getAnswer($submission->submission_id, $questionId, $peer->student_id);
				}
			}

			return View::make('teacher.form.response.view')->with(['submission' => $submission,
				'periodId' => $periodId,
				'formId' => $formId,
				'studentId' => $studentId,
				'self' => $student,
				'peerList' => $peerList,
				'questions' => $questions]);
		}
	}


	public function formResponseExcel($periodId)
	{
		// get all of the students in this period.
		$period = PeriodService::find($periodId);
		$studentList = $period->students;

		// get all forms in this period
		$forms = FormService::getList($periodId);

		// fill in the first line of the excel
		$value = ["Person Id", "Email", "Surname", "Title", "Given Name", "Teach Period", "Unit Code", "Team ID"];
		foreach($forms as $form)
		{
			array_push($value, $form->form_id);
		}
		$output = implode(",", $value) . "\n";

		foreach ($studentList as $student)
		{
			$student->person = $student->person;

			$value = [$student->student_id,
				$student->person->email,
				$student->person->last_name,
				$student->person->title,
				$student->person->first_name,
				$period->year,
				$period->unit_code,
				$student->team($periodId)->team_id,
			];

			foreach($forms as $form)
			{
				$formId = $form->form_id;
				// get all valid submissions in this form
				$submissions = SubmissionModel::where('form_id', $formId)
					->where('status', 'submitted')->select('submission_id')->get()->toArray();

				// get all question id that is used for marks calculation
				$selfQuestions = QuestionModel::whereHas('section', function ($q) use ($formId) {
					$q->where('form_id', $formId);
				})->where('format', 'multi')
					->where('type', 'self')
					->select('question_id')->get()->toArray();

				$peerQuestions = QuestionModel::whereHas('section', function ($q) use ($formId) {
					$q->where('form_id', $formId);
				})->where('format', 'multi')
					->where('type', 'peer')
					->select('question_id')->get()->toArray();

				// find the submission for this student.
				$submission = SubmissionModel::where('form_id', $formId)
					->where('student_id', $student->student_id)
					->where('status', 'submitted')
					->first();

				if (!is_null($submission))
				{
					$selfMarks = AnswerModel::whereIn('submission_id', $submissions)
						->whereIn('question_id', $selfQuestions)
						->where('target_student_id', $student->student_id)->avg('input');
					$peerMarks = AnswerModel::whereIn('submission_id', $submissions)
						->whereIn('question_id', $peerQuestions)
						->where('target_student_id', $student->student_id)->avg('input');
					$peerCount = AnswerModel::whereIn('submission_id', $submissions)
						->whereIn('question_id', $peerQuestions)
						->where('target_student_id', $student->student_id)->groupBy('submission_id')->count();

					$marks = ($selfMarks + ($peerMarks * $peerCount)) / ($peerCount + 1) / 2;

				}
				else
				{
					$marks = 0;
				}
				array_push($value, number_format($marks, 2));
			}
			$output .= implode(",", $value) . "\n";
		}

		$headers = array(
			'Content-Type' => 'text/csv',
			'Content-Disposition' => 'attachment; filename="' . 'ResultsForForm' . $formId . '.csv"',
		);

		return Response::make(rtrim($output, "\n"), 200, $headers);
	}



	public function formExcel($periodId)
	{
		// get all of the students in this period.
		$period = PeriodService::find($periodId);
		$studentList = $period->students;

		// get all submissions submitted in this form
		$submissions = SubmissionModel::where('form_id', $formId)
			->where('status','submitted')->select('submission_id')->get()->toArray();

		// get all question id that is used for marks calculation
		$selfQuestions = QuestionModel::whereHas('section', function ($q) use ($formId) {
			$q->where('form_id', $formId);
		})->where('format', 'multi')
			->where('type', 'self')
			->select('question_id')->get()->toArray();

		$peerQuestions = QuestionModel::whereHas('section', function ($q) use ($formId) {
			$q->where('form_id', $formId);
		})->where('format', 'multi')
			->where('type', 'peer')
			->select('question_id')->get()->toArray();

		$value = ["Person Id", "Email", "Surname", "Title", "Given Name", "Teach Period", "Unit Code", "Team ID", "Marks"];
		$output = implode(",",$value) . "\n";

		$test = '';
		foreach($studentList as $student)
		{
			// find the submission for this student.
			$submission  = SubmissionModel::where('form_id', $formId)
				->where('student_id', $student->student_id)
				->where('status', 'submitted')
				->first();

			if(!is_null($submission))
			{
				$selfMarks =  AnswerModel::whereIn('submission_id', $submissions)
					->whereIn('question_id', $selfQuestions)
					->where('target_student_id', $student->student_id)->avg('input');
				$peerMarks = AnswerModel::whereIn('submission_id', $submissions)
					->whereIn('question_id', $peerQuestions)
					->where('target_student_id', $student->student_id)->avg('input');
				$peerCount = AnswerModel::whereIn('submission_id', $submissions)
					->whereIn('question_id', $peerQuestions)
					->where('target_student_id', $student->student_id)->groupBy('submission_id')->count();

				$marks = ($selfMarks + ($peerMarks * $peerCount))/ ($peerCount + 1) /2;

			}
			else {
				$marks = 0;
			}
			$student->person = $student->person;

			$value = [$student->student_id,
				$student->person->email,
				$student->person->last_name,
				$student->person->title,
				$student->person->first_name,
				$period->year,
				$period->unit_code,
				$student->team($periodId)->team_id,
				number_format($marks, 2),
			];
			$output .=  implode(",",$value) . "\n";

		}

		$headers = array(
			'Content-Type' => 'text/csv',
			'Content-Disposition' => 'attachment; filename="' . 'ResultsForForm' . $formId . '.csv"',
		);

		return Response::make(rtrim($output, "\n"), 200, $headers);
	}
}
