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
Route::get('/teacher/{period}/student/create', ['uses' => 'TeacherController@studentCreate', 'as' => 'teacher.student.create', 'before' => 'teacher']);
Route::post('/teacher/{period}/student/create', ['uses' => 'TeacherController@storeStudentCreate', 'as' => 'teacher.student.storeCreate', 'before' => 'teacher']);
Route::get('/teacher/{period}/student/{studentId}/edit', ['uses' => 'TeacherController@studentEdit', 'as' => 'teacher.student.edit', 'before' => 'teacher']);
Route::post('/teacher/{period}/student/{studentId}/edit', ['uses' => 'TeacherController@storeStudentEdit', 'as' => 'teacher.student.edit', 'before' => 'teacher']);
Route::delete('/teacher/{period}/student/{studentId}/edit', ['uses' => 'TeacherController@storeStudentDelete', 'as' => 'teacher.student.delete', 'before' => 'teacher']);

Route::get('/teacher/uploadlist', ['uses' => 'TeacherController@uploadList', 'as' => 'teacher.period.uploadList', 'before' => 'teacher']);
Route::post('/teacher/uploadlist', ['uses' => 'TeacherController@storeUploadList', 'as' => 'teacher.period.storeUploadList', 'before' => 'teacher']);

Route::get('/teacher/{period}/form', ['uses' => 'TeacherController@formIndex', 'as' => 'teacher.form.index', 'before' => 'teacher']);
Route::get('/teacher/{period}/form/create', ['uses' => 'TeacherController@formCreate', 'as' => 'teacher.form.create', 'before' => 'teacher']);
Route::post('/teacher/{period}/form/create', ['uses' => 'TeacherController@storeFormCreate', 'as' => 'teacher.form.storeCreate', 'before' => 'teacher']);

Route::get('/teacher/{period}/{form}/response', ['uses' => 'TeacherController@formResponse', 'as' => 'teacher.form.response', 'before' => 'teacher']);
Route::get('/teacher/{period}/{form}/response/{studentId}', ['uses' => 'TeacherController@formResponseStudent', 'as' => 'teacher.form.response.student', 'before' => 'teacher']);

Route::get('/teacher/{period}/{form}/{type}/question', ['uses' => 'TeacherController@formQuestion', 'as' => 'teacher.form.question', 'before' => 'teacher']);
Route::get('/teacher/{period}/{form}/{type}/question/create', ['uses' => 'TeacherController@formQuestionCreate', 'as' => 'teacher.form.question.create', 'before' => 'teacher']);
Route::post('/teacher/{period}/{form}/{type}/question/create', ['uses' => 'TeacherController@formQuestionStoreCreate', 'as' => 'teacher.form.question.storeCreate', 'before' => 'teacher']);

Route::get('/teacher/{period}/response/excel', ['uses' => 'TeacherController@formResponseExcel', 'as' => 'teacher.form.response.excel', 'before' => 'teacher']);


// token link access areas
Route::get('/token/{token}/setpassword', ['uses' => 'TokenController@setPassword', 'as' => 'token.setPassword', 'before' => 'token']);
Route::post('/token/{token}/setpassword', ['uses' => 'TokenController@storePassword', 'as' => 'token.storePassword', 'before' => 'token']);
Route::get('/token/{token}/evaluation', ['uses' => 'TokenController@evaluation', 'as' => 'token.evaluation.index', 'before' => 'token']);
Route::get('/token/{token}/evaluation/{formId}/{selfId}/confirm', ['uses' => 'TokenController@evaluationConfirm', 'as' => 'token.evaluation.confirm', 'before' => 'token|submissionForm']);
Route::post('/token/{token}/evaluation/{formId}/{selfId}/confirm', ['uses' => 'TokenController@evaluationStoreConfirm', 'as' => 'token.evaluation.storeConfirm', 'before' => 'token|submissionForm']);
Route::get('/token/{token}/evaluation/{formId}/{selfId}/{targetId}', ['uses' => 'TokenController@evaluationForm', 'as' => 'token.evaluation.form', 'before' => 'token|submissionForm']);
Route::post('/token/{token}/evaluation/{formId}/{selfId}/{targetId}', ['uses' => 'TokenController@evaluationStore', 'as' => 'token.evaluation.storeForm', 'before' => 'token|submissionForm']);

