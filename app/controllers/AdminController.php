<?php

class AdminController extends BaseController {

	public function index()
	{
		$user = Auth::user();

		return View::make('admin.index')->with(['user' => $user]);
	}

	public function userIndex()
	{
		$users = UserRepository::approvedUserList();
		$pendingUsers = UserRepository::pendingUserList();
		return View::make('admin.user.index', ['users' => $users, 'pendingUsers' => $pendingUsers]);
	}

	public function userApproval($id)
	{
		$user = UserRepository::find($id);
		if($user->status == 'Pending')
		{
			return View::make('admin.user.approval')->with(['user' => $user]);
		}
	}

	public function storeUserApproval($id)
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

	public function userEdit($id)
	{
		$user = UserRepository::find($id);
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
		$user = UserRepository::find($id);
		$input = Input::all();
		try
		{
			UserRepository::updateUser($user, $input);
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
		$user = UserRepository::find($id);
		if(UserRepository::deleteUser($user) == true)
		{
			MessageService::alert('User account ' . UserRepository::$message . ' has been deleted');
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
		UserRepository::createUser(Input::all());

		return Redirect::route(	'admin.user.index');
	}
}
