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
		}
		elseif(Input::get('reject'))
		{
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
		if(Input::get('save'))
		{
			return $this->saveUser($id); //if login then use this method
		}
		elseif(Input::get('delete'))
		{
			return $this->deleteUser($id); //if register then use this method
		}
	}

	private function saveUser($id)
	{
		$user = UserService::find($id);
		if($user->role == 'Admin')
		{
			$validate = ValidationService::validateAdminEdit(Input::all());
		}
		else
		{
			$validate = ValidationService::validateTeacherEdit(Input::all());
		}

		if($validate != false)
		{
			if(Input::has('password') || Input::has('confirm_password'))
			{
				if(ValidationService::validatePassword(Input::all()) == false)
				{
					return Redirect::back()->withInput();
				}
			}

			UserService::updateUser($user, Input::all());
			MessageService::alert('Your changes have been saved successfully.');
			return Redirect::route('admin.user.index');
		}
		else
		{
			return Redirect::back()->withInput();
		}
	}

	private function deleteUser($id)
	{
		$user = UserService::find($id);
		if(UserService::deleteUser($user) == true)
		{
			MessageService::alert('User account ' . UserService::$message . ' has been deleted');
			return Redirect::route('admin.user.index');
		}
		else
		{
			MessageService::error('An error has occured');
			return Redirect::route('admin.user.index');
		}
	}

	public function userCreate()
	{
		return View::make('admin.user.create');
	}

	public function storeUserCreate()
	{
		if(Input::get('role') == 'Admin')
		{
			$validate = ValidationService::validateAdminCreate(Input::all());
		}
		else
		{
			$validate = ValidationService::validateTeacherCreate(Input::all());
		}

		if($validate != false)
		{
			UserService::createUser(Input::all());
			MessageService::alert('A new user has been created successfully.');
			return Redirect::route(	'admin.user.index');
		}
		else
		{
			return Redirect::back()->withInput();
		}
	}

	public function configIndex()
	{

	}
}
