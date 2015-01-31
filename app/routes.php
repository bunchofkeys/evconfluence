<?php

// public routes

// register page
Route::get('/register', ['uses' => 'UserController@register', 'as' => 'user.register']);
Route::post('/register', ['uses' => 'UserController@storeRegister', 'as' => 'user.storeRegister']);

// Session login
Route::get('/', ['uses' => 'SessionController@login', 'as' => 'session.login']);
Route::post('/', ['uses' => 'SessionController@auth', 'as' => 'session.auth']);
Route::get('/logout', ['uses' => 'SessionController@logout', 'as' => 'session.logout']);

// admin access areas
Route::get('/admin', ['uses' => 'AdminController@index', 'as' => 'admin.index', 'before' => 'admin']);
Route::get('/admin/user', ['uses' => 'UserController@index', 'as' => 'admin.user.index', 'before' => 'admin']);
Route::get('/admin/user/{id}/edit', ['uses' => 'UserController@edit', 'as' => 'admin.user.edit', 'before' => 'admin']);
Route::put('/admin/user/{id}/edit', ['uses' => 'UserController@update', 'as' => 'admin.user.update', 'before' => 'admin']);
Route::get('/admin/user/create', ['uses' => 'UserController@create', 'as' => 'admin.user.create', 'before' => 'admin']);
Route::post('/admin/user/create', ['uses' => 'UserController@store', 'as' => 'admin.user.store', 'before' => 'admin']);
Route::get('/admin/user/{id}/approval', ['uses' => 'UserController@approval', 'as' => 'admin.user.approval', 'before' => 'admin']);
Route::post('/admin/user/{id}/approval', ['uses' => 'UserController@storeApproval', 'as' => 'admin.user.storeApproval', 'before' => 'admin']);

// teacher access areas
Route::get('/teacher', ['uses' => 'TeacherController@index', 'as' => 'teacher.index', 'before' => 'teacher']);
Route::get('/teacher/semester', ['uses' => 'TeacherController@semester', 'as' => 'teacher.semester', 'before' => 'teacher']);
Route::get('/teacher/semester/create', ['uses' => 'TeacherController@semesterCreate', 'as' => 'teacher.semester.create', 'before' => 'teacher']);

// temporary link access areas
Route::get('/token/{token}/setpassword', ['uses' => 'TokenController@setpassword', 'as' => 'token.setpassword']);
Route::post('/token/{token}/setpassword', ['uses' => 'TokenController@storepassword', 'as' => 'token.storepassword']);


