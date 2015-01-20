<?php

class AdminController extends \BaseController {

	public function index()
	{
		$email = Auth::user();

		return View::make('admin.index')->with(['email' => $email]);
	}


}
