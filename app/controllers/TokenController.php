<?php

class TokenController extends \BaseController {

	public function setPassword($token)
	{
		$validLink = $this->checkTokenValid($token);
		if($validLink != null)
		{
			$person = PersonService::find($validLink->person_id);
			return View::make('token.setpassword')->with(['person' => $person]);
		}
		return Redirect::route('session.login');
	}

	public function storePassword($token)
	{
		$validLink = $this->checkTokenValid($token);
		if($validLink != null)
		{
			$person = PersonService::find($validLink->person_id);
			$user = UserService::find($person->user->user_id);
			$user->password = Hash::make(Input::get('password'));
			$user->save();

			$validLink->active = false;
			$validLink->save();
		}
		return Redirect::route('session.login');
	}

	private function checkTokenValid($token)
	{
		$temporaryLink = TemporaryLink::where('token', $token)->first();
		if($temporaryLink != null)
		{
			$now = new DateTime("now");
			if($temporaryLink->active == true)
			{
				return $temporaryLink;
			}
		}
		return null;
	}
}
