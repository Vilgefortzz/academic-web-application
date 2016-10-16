<?php

// Students
Route::get('/students', 'StudentsController@index');
Route::get('/students/{student}', 'StudentsController@show');
Route::get('/students/{student}/edit', 'StudentsController@edit_password');
Route::patch('/students/{student}', 'StudentsController@change_password');

// Teachers
Route::get('/teachers', 'TeachersController@index');
Route::get('/teachers/{teacher}', 'TeachersController@show');
Route::get('/teachers/{teacher}/edit', 'TeachersController@edit_password');
Route::patch('/teachers/{teacher}', 'TeachersController@change_password');