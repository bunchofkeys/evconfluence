<?php

class AdminController extends BaseController {

	public function index()
	{
		$user = Auth::user();

		return View::make('admin.index')->with(['user' => $user]);
	}


}
