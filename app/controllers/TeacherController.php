<?php

class TeacherController extends \BaseController {

	public function index()
	{
		$user = Auth::user();
		return View::make('teacher.index')->with(['user' => $user]);
	}

	public function semester()
	{
		$user = Auth::user();
		return View::make('teacher.semester.index');
	}

}
