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
				MessageService::error('You do not have permission to access this');
				return Redirect::back()->withInput();
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
			MessageService::error('Incorrect Email / Password');
			return Redirect::back()->withInput();
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

	public function forgetPassword()
	{
		return View::Make('home.forgetpassword');
	}

	public function storeForgetPassword()
	{
		$input = Input::all();
		if(ValidationService::validateResetPassword($input) != false) {
			$person = PersonService::findByEmail($input['email']);
			if(!is_null($person))
			{
				$user = UserModel::where('person_id', $person->person_id)->first();
				if (!is_null($user))
				{
					$user->person = $user->person;
					if($user->status == 'Approved')
					{
						$url = EmailService::sendResetPasswordEmail($user);
						MessageService::alert('An email has been sent to your email address to reset password.');
						return Redirect::route('session.login')->with(['user' => $user, 'url' => $url]);
					}
					else
					{
						MessageService::error(['email' => 'Account is not approved yet']);
						return Redirect::back()->withInput();
					}
				}
				else
				{
					MessageService::error(['email' => 'Email does not exist']);
					return Redirect::back()->withInput();
				}
			}
		}
		else
		{
			return Redirect::back()->withInput();
		}
	}
}

