<?php

class SessionController extends BaseController {

	public function login()
	{
		return View::Make('home.login');
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
					return Redirect::intended(URL::route('admin.index'));
				}
				else if($user->role == 'Teacher')
				{
					return Redirect::intended(URL::route('teacher.index'));
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

	public function userRegister()
	{
		return View::make('home.register');
	}

	public function saveUserRegister()
	{
		if(ValidationService::validateRegistration(Input::all()) != false)
		{
			$user = UserService::registerTeacher(Input::all());
			EmailService::sendRegistrationNotification($user);
			MessageService::alert('Your registration have been process and will be reviewed by the administrator.');
			return Redirect::route(	'session.login');
		}
		else
		{
			return Redirect::back()->withInput();
		}
	}
}
