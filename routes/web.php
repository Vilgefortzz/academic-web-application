<?php

// Students
Route::get('/students', 'StudentsController@index');
Route::get('/students/{student}', 'StudentsController@show');
Route::get('/students/{student}/edit', 'StudentsController@edit_password');
Route::patch('/students/{student}', 'StudentsController@change_password');