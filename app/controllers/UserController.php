<?php

class UserController extends BaseController {

	public function index()
	{
		$users = UserRepository::approvedUserList();
		$pendingUsers = UserRepository::pendingUserList();
		return View::make('admin.user.index', ['users' => $users, 'pendingUsers' => $pendingUsers]);
	}

	public function approval($id)
	{
		$user = UserRepository::find($id);
		if($user->status == 'Pending')
		{
			return View::make('admin.user.approval')->with(['user' => $user]);
		}
	}

	public function storeApproval($id)
	{
		$user = UserRepository::find($id);
		if(Input::get('approve'))
		{
			EmailRepository::sendConfirmationEmail($user);
			UserRepository::updateUser($user, ['status' => 'Approved']);
		} elseif(Input::get('reject')) {
			EmailRepository::sendRejectEmail($user);
			UserRepository::updateUser($user, ['status' => 'Rejected']);
		}
		return $this->index();
	}

	public function edit($id)
	{
		$user = UserRepository::find($id);
		return View::make('admin.user.edit')->with(['user' => $user]);
	}

	public function update($id)
	{
		if(Input::get('save')) {
			return $this->save($id); //if login then use this method
		} elseif(Input::get('delete')) {
			return $this->delete($id); //if register then use this method
		}
	}

	private function save($id)
	{
		$user = UserRepository::find($id);
		$input = Input::all();
		try
		{
			UserRepository::updateUser($user, $input);
			return View::make('admin.user.edit')->with(['user' => $user, 'messages' => ['success' => 'Your changes have been saved successfully.']]);
		}
		catch (mysqli_sql_exception $ex)
		{
			return View::make('admin.user.edit')->with(['user' => $user, 'messages' => ['danger' => 'An error has occured.']]);
		}
	}

	private function delete($id)
	{
		$user = UserRepository::find($id);
		if(UserRepository::deleteUser($user) == true)
		{
			return $this->index()->with(['messages' => ['success' => 'User account ' . UserRepository::$message . ' has been deleted']]);
		}
		else
		{
			return $this->index()->with(['messages' => ['danger' => 'An error has occured']]);
		}
	}


	public function create()
	{
		return View::make('admin.user.create');
	}

	public function store()
	{
		UserRepository::createUser(Input::all());

		return Redirect::route(	'admin.user.index');
	}

	public function register()
	{
		return View::make('home.register');
	}

	public function storeRegister()
	{
		$success = UserRepository::registerTeacher(Input::all());

		if($success == true)
		{
			return Redirect::route(	'session.login')->with(['messages' => ['success' => 'Your registration have been process and will be reviewed by the administrator.']]);
		}
		else
		{
			return Redirect::route(	'session.login')->with(['messages' => ['danger' => UserRepository::errors]]);
		}

	}
}