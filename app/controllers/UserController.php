<?php

class UserController extends \BaseController {

	public function index()
	{
		$id = Auth::user()->id;
		$users = User::where('id', '!=', $id)->get();
		$pendingUsers = User::where('status', '=', 'Pending')->get();
		return View::make('admin.user.index', ['users' => $users, 'pendingUsers' => $pendingUsers]);
	}

	public function edit($id)
	{
		$user = User::where('id', '=', $id)->first();
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
		$user = User::where('id', '=', $id)->first();
		$user->fill(Input::only(['first_name', 'last_name', 'unit_required_for', 'school']));

		$password = Input::get('password');
		$confirmPassword = Input::get('confirm_password');
		if($password == $confirmPassword)
		{
			$user->password = Hash::make($password);
		}

		$user->save();
		return View::make('admin.user.edit')->with(['user' => $user, 'messages' => ['success' => 'Your changes have been saved successfully.']]);
	}

	private function delete($id)
	{
		$user = User::where('id', '=', $id)->first();
		$email = $user->email;
		$user->delete();

		return $this->index()->with(['messages' => ['danger' => 'User account ' . $email . ' has been deleted']]);
	}


	public function create()
	{
		return View::make('admin.user.create');
	}

	public function store()
	{
		$user = new user();
		$user->fill(Input::only(['email', 'first_name', 'last_name', 'unit_required_for', 'school', 'role']));

		$password = Input::get('password');
		$confirmPassword = Input::get('confirm_password');
		if($password == $confirmPassword)
		{
			$user->password = Hash::make($password);
		}
		$user->status = 'Approved';
		$user->save();

		return Redirect::route(	'admin.user.index');
	}

	public function register()
	{
		return View::make('home.register');
	}

	public function storeRegister()
	{
		$user = new user();
		$user->fill(Input::only(['email', 'first_name', 'last_name', 'unit_required_for', 'school']));

		$password = Input::get('password');
		$confirmPassword = Input::get('confirm_password');
		if($password == $confirmPassword)
		{
			$user->password = Hash::make($password);
		}
		$user->status = 'Pending';
		$user->role = 'Staff';
		$user->save();

		return Redirect::route(	'session.login')->with(['messages' => ['success' => 'Your registration have been process and will be reviewed by the administrator.']]);
	}
}