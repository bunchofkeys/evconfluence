<?php

class AdminController extends BaseController {

	public function index()
	{
		$user = Auth::user();

		return View::make('admin.index')->with(['user' => $user]);
	}

	public function userIndex()
	{
		$users = UserService::approvedUserList();
		$pendingUsers = UserService::pendingUserList();
		return View::make('admin.user.index', ['users' => $users, 'pendingUsers' => $pendingUsers]);
	}

	public function userApproval($id)
	{
		$user = UserService::find($id);
		if($user->status == 'Pending')
		{
			return View::make('admin.user.approval')->with(['user' => $user]);
		}
	}

	public function storeUserApproval($id)
	{
		$user = UserService::find($id);
		if(Input::get('approve'))
		{
			EmailService::sendConfirmationEmail($user);
			UserService::updateUser($user, ['status' => 'Approved']);
		} elseif(Input::get('reject')) {
			EmailService::sendRejectEmail($user);
			UserService::updateUser($user, ['status' => 'Rejected']);
		}
		return $this->index();
	}

	public function userEdit($id)
	{
		$user = UserService::find($id);
		return View::make('admin.user.edit')->with(['user' => $user]);
	}

	public function storeUserEdit($id)
	{
		if(Input::get('save')) {
			return $this->saveUser($id); //if login then use this method
		} elseif(Input::get('delete')) {
			return $this->deleteUser($id); //if register then use this method
		}
	}

	private function saveUser($id)
	{
		$user = UserService::find($id);
		$input = Input::all();
		try
		{
			UserService::updateUser($user, $input);
			MessageService::alert('Your changes have been saved successfully.');
			return View::make('admin.user.edit');
		}
		catch (mysqli_sql_exception $ex)
		{
			MessageService::error();
			return View::make('admin.user.edit');
		}
	}

	private function deleteUser($id)
	{
		$user = UserService::find($id);
		if(UserService::deleteUser($user) == true)
		{
			MessageService::alert('User account ' . UserService::$message . ' has been deleted');
			return $this->index();
		}
		else
		{
			MessageService::error();
			return $this->index();
		}
	}

	public function userCreate()
	{
		return View::make('admin.user.create');
	}

	public function storeUserCreate()
	{
		UserService::createUser(Input::all());

		return Redirect::route(	'admin.user.index');
	}
}
