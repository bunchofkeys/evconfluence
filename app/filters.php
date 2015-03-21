<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('admin', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			MessageService::error('Unauthorized');
			return View::make('home.invalid');
		}
		else
		{
			return Redirect::guest('/');
		}
	}

	if(Auth::user()->role != 'Admin')
	{
		Auth::logout();
		MessageService::error('Unauthorized');
		return View::make('home.invalid');
	}

});

Route::filter('token', function($route)
{
	$temporaryLink = TokenService::find($route->getParameter('token'));
	if(is_null($temporaryLink))
	{
		MessageService::error('Invalid/Expired Token');
		return View::make('home.invalid');
	}
	else
	{
		if ($temporaryLink->active == false)
		{
			MessageService::error('Invalid/Expired Token');
			return View::make('home.invalid');
		}
	}
	return;
});

Route::filter('submissionForm', function($route)
{
	$form = FormModel::find($route->getParameter('formId'));
	if(is_null($form))
	{
		MessageService::error('Page Not Found');
		return View::make('home.invalid');
	}
	else
	{
		$student = StudentService::find($route->getParameter('selfId'));
		$submission = SubmissionService::find($form->form_id, $student->student_id);
		if(is_null($submission))
		{
			return;
		}
		if($submission->status == "Submitted")
		{
			MessageService::error('You have already submitted the evaluation');
			return Redirect::route('token.evaluation.index', ['token' => $route->getParameter('token')]);
		}
	}
});

Route::filter('teacher', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('/');
		}
	}

	if(Auth::user()->role != 'Teacher')
	{
		Auth::logout();
		return Response::make('Unauthorized', 401);
	}

});

Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() !== Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
