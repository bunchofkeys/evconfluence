<?php

// public routes

// register page
Route::get('/register', ['uses' => 'SessionController@userRegister', 'as' => 'session.userRegister']);
Route::post('/register', ['uses' => 'SessionController@saveUserRegister', 'as' => 'session.saveUserRegister']);

// Session login
Route::get('/', ['uses' => 'SessionController@login', 'as' => 'session.login']);
Route::post('/', ['uses' => 'SessionController@auth', 'as' => 'session.auth']);
Route::get('/logout', ['uses' => 'SessionController@logout', 'as' => 'session.logout']);

// admin access areas
Route::get('/admin', ['uses' => 'AdminController@index', 'as' => 'admin.index', 'before' => 'admin']);
Route::get('/admin/user', ['uses' => 'AdminController@userIndex', 'as' => 'admin.user.index', 'before' => 'admin']);
Route::get('/admin/user/{id}/edit', ['uses' => 'AdminController@userEdit', 'as' => 'admin.user.edit', 'before' => 'admin']);
Route::put('/admin/user/{id}/edit', ['uses' => 'AdminController@storeUserEdit', 'as' => 'admin.user.storeUserEdit', 'before' => 'admin']);
Route::get('/admin/user/create', ['uses' => 'AdminController@userCreate', 'as' => 'admin.user.create', 'before' => 'admin']);
Route::post('/admin/user/create', ['uses' => 'AdminController@storeUserCreate', 'as' => 'admin.user.storeUserCreate', 'before' => 'admin']);
Route::get('/admin/user/{id}/approval', ['uses' => 'AdminController@userApproval', 'as' => 'admin.user.approval', 'before' => 'admin']);
Route::post('/admin/user/{id}/approval', ['uses' => 'AdminController@storeUserApproval', 'as' => 'admin.user.storeUserApproval', 'before' => 'admin']);

// teacher access areas
Route::get('/teacher', ['uses' => 'TeacherController@index', 'as' => 'teacher.index', 'before' => 'teacher']);
Route::get('/teacher/period', ['uses' => 'TeacherController@periodIndex', 'as' => 'teacher.period.index', 'before' => 'teacher']);
Route::get('/teacher/period/create', ['uses' => 'TeacherController@periodCreate', 'as' => 'teacher.period.create', 'before' => 'teacher']);
Route::post('/teacher/period/create', ['uses' => 'TeacherController@storePeriodCreate', 'as' => 'teacher.period.storeCreate', 'before' => 'teacher']);
Route::get('/teacher/{period}/student', ['uses' => 'TeacherController@studentIndex', 'as' => 'teacher.student.index', 'before' => 'teacher']);
Route::get('/teacher/uploadlist', ['uses' => 'TeacherController@uploadList', 'as' => 'teacher.period.uploadList', 'before' => 'teacher']);
Route::post('/teacher/uploadlist', ['uses' => 'TeacherController@storeUploadList', 'as' => 'teacher.period.storeUploadList', 'before' => 'teacher']);

Route::get('/teacher/{period}/form', ['uses' => 'TeacherController@formIndex', 'as' => 'teacher.form.index', 'before' => 'teacher']);
Route::get('/teacher/{period}/form/create', ['uses' => 'TeacherController@formCreate', 'as' => 'teacher.form.create', 'before' => 'teacher']);
Route::post('/teacher/{period}/form/create', ['uses' => 'TeacherController@storeFormCreate', 'as' => 'teacher.form.storeCreate', 'before' => 'teacher']);
Route::get('/teacher/{period}/{form}/{type}/question', ['uses' => 'TeacherController@formQuestion', 'as' => 'teacher.form.question', 'before' => 'teacher']);
Route::get('/teacher/{period}/{form}/{type}/question/create', ['uses' => 'TeacherController@formQuestionCreate', 'as' => 'teacher.form.question.create', 'before' => 'teacher']);
Route::post('/teacher/{period}/{form}/{type}/question/create', ['uses' => 'TeacherController@formQuestionStoreCreate', 'as' => 'teacher.form.question.storeCreate', 'before' => 'teacher']);

// temporary link access areas
Route::get('/token/{token}/setpassword', ['uses' => 'TokenController@setPassword', 'as' => 'token.setPassword']);
Route::post('/token/{token}/setpassword', ['uses' => 'TokenController@storePassword', 'as' => 'token.storePassword']);


