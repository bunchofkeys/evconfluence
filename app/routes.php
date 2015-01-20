<?php

// public routes

// register page
Route::get('/register', ['uses' => 'UserController@register', 'as' => 'user.register']);
Route::post('/register', ['uses' => 'UserController@storeRegister', 'as' => 'user.storeRegister']);

// Session login
Route::get('/', ['uses' => 'SessionController@login', 'as' => 'session.login']);
Route::post('/', ['uses' => 'SessionController@auth', 'as' => 'session.auth']);
Route::get('/logout', ['uses' => 'SessionController@logout', 'as' => 'session.logout']);

// logged in page
Route::get('/admin', ['uses' => 'AdminController@index', 'as' => 'admin.index', 'before' => 'auth']);

// admin user management
Route::get('/admin/user', ['uses' => 'UserController@index', 'as' => 'admin.user.index', 'before' => 'auth']);
Route::get('/admin/user/{user}/edit', ['uses' => 'UserController@edit', 'as' => 'admin.user.edit', 'before' => 'auth']);
Route::put('/admin/user/{user}/edit', ['uses' => 'UserController@update', 'as' => 'admin.user.update', 'before' => 'auth']);
Route::get('/admin/user/create', ['uses' => 'UserController@create', 'as' => 'admin.user.create', 'before' => 'auth']);
Route::post('/admin/user/create', ['uses' => 'UserController@store', 'as' => 'admin.user.store', 'before' => 'auth']);

Route::get('/test', ['uses' => 'UserController@test', 'as' => 'admin.user.test']);



