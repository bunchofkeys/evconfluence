<?php

class SessionController extends \BaseController {

	public function login()
	{
		$messages = Session::get('messages');

		return View::Make('home.login')->with('messages', $messages);
	}

	public function auth()
	{
		if(Auth::attempt(Input::only('email', 'password')))
		{
			if(($status = Auth::user()->status) != 'Approved')
			{
				Auth::logout();
				if($status == 'Pending') {
					return Redirect::back()->withInput()->withErrors(['error' => 'Your account is not activated']);
				}
				else if($status == 'Locked'){
					return Redirect::back()->withInput()->withErrors(['error' => 'You have been locked out']);
				}
				else
				{
					return Redirect::back()->withInput()->withErrors(['error' => 'You do not have permission to access this']);
				}
			}
			else
			{
				return Redirect::to(route('admin.index'));
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
