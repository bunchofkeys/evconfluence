<?php

// public routes

// register page
Route::get('/register', ['uses' => 'SessionController@userRegister', 'as' => 'session.userRegister']);
Route::post('/register', ['uses' => 'SessionController@saveUserRegister', 'as' => 'session.saveUserRegister']);

// Session login
Route::get('/', ['uses' => 'SessionController@login', 'as' => 'session.login']);
Route::post('/', ['uses' => 'SessionController@auth', 'as' => 'session.auth', 'before' => 'csrf']);
Route::get('/logout', ['uses' => 'SessionController@logout', 'as' => 'session.logout']);
Route::get('/forgetpassword', ['uses' => 'SessionController@forgetPassword', 'as' => 'session.forgetPassword']);
Route::post('/forgetpassword', ['uses' => 'SessionController@storeForgetPassword', 'as' => 'session.storeForgetPassword', 'before' => 'csrf']);


// admin access areas
Route::get('/admin', ['uses' => 'AdminController@index', 'as' => 'admin.index', 'before' => 'admin']);
Route::get('/admin/user', ['uses' => 'AdminController@userIndex', 'as' => 'admin.user.index', 'before' => 'admin']);
Route::get('/admin/user/{id}/edit', ['uses' => 'AdminController@userEdit', 'as' => 'admin.user.edit', 'before' => 'admin']);
Route::put('/admin/user/{id}/edit', ['uses' => 'AdminController@storeUserEdit', 'as' => 'admin.user.storeUserEdit', 'before' => 'admin']);
Route::get('/admin/user/create', ['uses' => 'AdminController@userCreate', 'as' => 'admin.user.create', 'before' => 'admin']);
Route::post('/admin/user/create', ['uses' => 'AdminController@storeUserCreate', 'as' => 'admin.user.storeUserCreate', 'before' => 'admin|csrf']);
Route::get('/admin/user/{id}/approval', ['uses' => 'AdminController@userApproval', 'as' => 'admin.user.approval', 'before' => 'admin']);
Route::post('/admin/user/{id}/approval', ['uses' => 'AdminController@storeUserApproval', 'as' => 'admin.user.storeUserApproval', 'before' => 'admin|csrf']);
Route::get('/admin/config', ['uses' => 'AdminController@configIndex', 'as' => 'admin.configuration.index', 'before' => 'admin']);
Route::post('/admin/config', ['uses' => 'AdminController@configStore', 'as' => 'admin.configuration.store', 'before' => 'admin|csrf']);


// teacher access areas
Route::get('/teacher', ['uses' => 'TeacherController@index', 'as' => 'teacher.index', 'before' => 'teacher']);
Route::get('/teacher/period', ['uses' => 'TeacherController@periodIndex', 'as' => 'teacher.period.index', 'before' => 'teacher']);
Route::get('/teacher/period/create', ['uses' => 'TeacherController@periodCreate', 'as' => 'teacher.period.create', 'before' => 'teacher']);
Route::post('/teacher/period/create', ['uses' => 'TeacherController@storePeriodCreate', 'as' => 'teacher.period.storeCreate', 'before' => 'teacher|csrf']);
Route::get('/teacher/{period}/edit', ['uses' => 'TeacherController@periodEdit', 'as' => 'teacher.period.edit', 'before' => 'teacher|period']);
Route::post('/teacher/{period}/edit', ['uses' => 'TeacherController@storePeriodEdit', 'as' => 'teacher.period.storeEdit', 'before' => 'teacher|period|csrf']);

Route::get('/teacher/{period}/student', ['uses' => 'TeacherController@studentIndex', 'as' => 'teacher.student.index', 'before' => 'teacher|period']);
Route::get('/teacher/{period}/student/create', ['uses' => 'TeacherController@studentCreate', 'as' => 'teacher.student.create', 'before' => 'teacher|period']);
Route::post('/teacher/{period}/student/create', ['uses' => 'TeacherController@storeStudentCreate', 'as' => 'teacher.student.storeCreate', 'before' => 'teacher|period|csrf']);
Route::get('/teacher/{period}/student/{studentId}/edit', ['uses' => 'TeacherController@studentEdit', 'as' => 'teacher.student.edit', 'before' => 'teacher|period']);
Route::post('/teacher/{period}/student/{studentId}/edit', ['uses' => 'TeacherController@storeStudentEdit', 'as' => 'teacher.student.edit', 'before' => 'teacher|period|csrf']);

Route::get('/teacher/uploadlist', ['uses' => 'TeacherController@uploadList', 'as' => 'teacher.period.uploadList', 'before' => 'teacher']);
Route::post('/teacher/uploadlist', ['uses' => 'TeacherController@storeUploadList', 'as' => 'teacher.period.storeUploadList', 'before' => 'teacher|csrf']);

Route::get('/teacher/{period}/form', ['uses' => 'TeacherController@formIndex', 'as' => 'teacher.form.index', 'before' => 'teacher|period']);
Route::get('/teacher/{period}/form/create', ['uses' => 'TeacherController@formCreate', 'as' => 'teacher.form.create', 'before' => 'teacher|period']);
Route::post('/teacher/{period}/form/create', ['uses' => 'TeacherController@storeFormCreate', 'as' => 'teacher.form.storeCreate', 'before' => 'teacher|period|csrf']);
Route::get('/teacher/{period}/form/{formId}/edit', ['uses' => 'TeacherController@formEdit', 'as' => 'teacher.form.edit', 'before' => 'teacher|period']);
Route::post('/teacher/{period}/form/{formId}/edit', ['uses' => 'TeacherController@storeFormEdit', 'as' => 'teacher.form.edit', 'before' => 'teacher|period|csrf']);

Route::get('/teacher/{period}/{form}/response', ['uses' => 'TeacherController@formResponse', 'as' => 'teacher.form.response', 'before' => 'teacher|period']);
Route::get('/teacher/{period}/{form}/response/{studentId}', ['uses' => 'TeacherController@formResponseStudent', 'as' => 'teacher.form.response.student', 'before' => 'teacher|period']);

Route::get('/teacher/{period}/{form}/{type}/question', ['uses' => 'TeacherController@formQuestion', 'as' => 'teacher.form.question', 'before' => 'teacher|period']);
Route::get('/teacher/{period}/{form}/{type}/question/create', ['uses' => 'TeacherController@formQuestionCreate', 'as' => 'teacher.form.question.create', 'before' => 'teacher|period']);
Route::post('/teacher/{period}/{form}/{type}/question/create', ['uses' => 'TeacherController@formQuestionStoreCreate', 'as' => 'teacher.form.question.storeCreate', 'before' => 'teacher|period|csrf']);
Route::get('/teacher/{period}/{form}/{type}/{questionId}/edit', ['uses' => 'TeacherController@formQuestionEdit', 'as' => 'teacher.form.question.edit', 'before' => 'teacher|period']);
Route::post('/teacher/{period}/{form}/{type}/{questionId}/edit', ['uses' => 'TeacherController@formQuestionStoreEdit', 'as' => 'teacher.form.question.storeEdit', 'before' => 'teacher|period|csrf']);

Route::get('/teacher/{period}/response/excel', ['uses' => 'TeacherController@formResponseExcel', 'as' => 'teacher.form.response.excel', 'before' => 'teacher|period']);


// token link access areas
Route::get('/token/{token}/setpassword', ['uses' => 'TokenController@setPassword', 'as' => 'token.setPassword', 'before' => 'token']);
Route::post('/token/{token}/setpassword', ['uses' => 'TokenController@storePassword', 'as' => 'token.storePassword', 'before' => 'token|csrf']);
Route::get('/token/{token}/evaluation', ['uses' => 'TokenController@evaluation', 'as' => 'token.evaluation.index', 'before' => 'token']);
Route::get('/token/{token}/evaluation/{formId}/{selfId}/begin', ['uses' => 'TokenController@evaluationBegin', 'as' => 'token.evaluation.begin', 'before' => 'token|submissionForm']);
Route::get('/token/{token}/evaluation/{formId}/{selfId}/confirm', ['uses' => 'TokenController@evaluationConfirm', 'as' => 'token.evaluation.confirm', 'before' => 'token|submissionForm']);
Route::post('/token/{token}/evaluation/{formId}/{selfId}/confirm', ['uses' => 'TokenController@evaluationStoreConfirm', 'as' => 'token.evaluation.storeConfirm', 'before' => 'token|submissionForm|csrf']);
Route::get('/token/{token}/evaluation/{formId}/{selfId}/{targetId}', ['uses' => 'TokenController@evaluationForm', 'as' => 'token.evaluation.form', 'before' => 'token|submissionForm']);
Route::post('/token/{token}/evaluation/{formId}/{selfId}/{targetId}', ['uses' => 'TokenController@evaluationStore', 'as' => 'token.evaluation.storeForm', 'before' => 'token|submissionForm|csrf']);

Route::get('/sendemail', function() {
    return (new DateTime())->format('Y-m-d H:i:s');
    return EmailService::sendStudentMail();
});