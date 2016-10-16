<?php

// Students
Route::get('/students', 'StudentsController@index');
Route::get('/students/{student}', 'StudentsController@show');