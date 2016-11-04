<?php

// MAIN PAGE

Route::get('/', function (){

    if (Auth::guard('student')->check()){

        return Redirect::to('/students/'. Auth::guard('student')->id() .'/home');
    }
    elseif (Auth::guard('teacher')->check()){

        return Redirect::to('/teachers/'. Auth::guard('teacher')->id() .'/home');
    }

    return view('main_page');
});

// Login

Route::get('/login', 'AuthController@login');
Route::post('/handleLogin', 'AuthController@handleLogin');

// Password reset

Route::get('/reset/password/panel', 'AuthController@resetPasswordPanel');
Route::post('/reset/password/email', 'AuthController@resetPasswordEmail');
Route::get('/reset/password/temp/{email}', 'AuthController@resetPasswordTemp');
Route::post('/reset/password/new/{email}', 'AuthController@resetPasswordNew');

// Logout

Route::post('/handleLogout', 'AuthController@handleLogout');

// Home dashboards

Route::get('/students/{student}/home', 'StudentsController@home');
Route::get('/teachers/{teacher}/home', 'TeachersController@home');

// Students

Route::get('/students', 'StudentsController@index');
Route::get('/students/{student}', 'StudentsController@show');
Route::get('/students/{student}/subjects', 'StudentsController@showSubjects');
Route::get('/students/{student}/edit', 'StudentsController@editPassword');
Route::patch('/students/{student}', 'StudentsController@changePassword');

// Teachers

Route::get('/teachers', 'TeachersController@index');
Route::get('/teachers/{teacher}', 'TeachersController@show');
Route::get('/teachers/{teacher}/subjects', 'TeachersController@showSubjects');
Route::get('/teachers/{teacher}/edit', 'TeachersController@editPassword');
Route::patch('/teachers/{teacher}', 'TeachersController@changePassword');

// Subjects

Route::get('/subjects', 'SubjectsController@index');
Route::get('/subjects/{subject}', 'SubjectsController@show');

// Upload and download files

Route::get('/fileentry/get/{original_filename}', [
    'as' => 'getentry', 'uses' => 'FileEntriesController@download']);
Route::post('/fileentry/add/{subject_id}', [
    'as' => 'addentry', 'uses' => 'FileEntriesController@upload']);

// Delete files

Route::delete('/fileentry/delete/{original_filename}', [
    'as' => 'deleteentry', 'uses' => 'FileEntriesController@delete']);

// Show grades

Route::get('/students/{student}/grades', 'StudentsController@showGrades');

// Panel with grades

Route::get('/teachers/{teacher}/grades/panel', 'TeachersController@showGradesPanel');

// Assign grades

Route::post('/grade/add', [
    'as' => 'addgrade', 'uses' => 'GradesController@assign']);

// Delete grades

Route::delete('/grade/delete/{grade_id}', [
    'as' => 'deletegrade', 'uses' => 'GradesController@delete']);

// Show messages

Route::get('/students/{student}/messages', 'StudentsController@showMessages');

// Panel with messages

Route::get('/teachers/{teacher}/messages/panel', 'TeachersController@showMessagesPanel');

// Add new message

Route::post('/message/add', [
    'as' => 'addmessage', 'uses' => 'MessagesController@add']);

// Delete message

Route::delete('/message/delete/{message_id}', [
    'as' => 'deletemessage', 'uses' => 'MessagesController@delete']);
