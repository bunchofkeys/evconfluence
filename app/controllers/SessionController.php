<?php

class SessionController extends BaseController {

	public function login()
	{
		$messages = Session::get('messages');
		return View::Make('home.login')->with('messages', $messages);
	}

	public function auth()
	{
		if(Auth::attempt(Input::only('username', 'password')))
		{
			$user = Auth::user();
			if($user->status != 'Approved')
			{
				Auth::logout();
				return Redirect::back()->withInput()->withErrors(['error' => 'You do not have permission to access this']);
			}
			else
			{
				if($user->role == 'Admin')
				{
					return Redirect::to(route('admin.index'));
				}
				else if($user->role == 'Teacher')
				{
					return Redirect::to(route('teacher.index'));
				}
			}

		}
		else
		{
			return Redirect::back()->withInput()->withErrors(['error' => 'Incorrect Email / Password']);
		}
	}


	public function logout()
	{
		Auth::logout();
		return Redirect::route('session.login');
	}


}
