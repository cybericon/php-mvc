<?php

use Core\Base\Route;

Route::get('', 'PagesController@home');
Route::get('about-us', 'PagesController@about');
Route::get('contact-us', 'PagesController@contact');

//Task application routes
Route::get('tasks', 'TasksController@index');
Route::get('task/{task}', 'TasksController@show');
Route::post('add-task', 'TasksController@store');
Route::post('delete-task', 'TasksController@delete');
Route::post('update-task', 'TasksController@update');
