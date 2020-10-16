<?php

Route::get('/', function(){
    return view('welcome');
});

Route::get('/usuarios', 'UserController@index')->name('users');
Route::get('/usuarios/{user}', 'UserController@show')
    ->where('user', '\d+')
    ->name('users.show');
Route::get('/usuarios/nuevo', 'UserController@create')->name('users.create');
Route::post('/usuarios', 'UserController@store')->name('users.store');
Route::get('/usuarios/{user}/edit', 'UserController@edit')
    ->where(['user' => '\d+'])
    ->name('users.edit');
Route::put('/usuarios/{user}', 'UserController@update')
    ->where(['user' => '\d+'])
    ->name('users.update');
Route::delete('/usuarios/{user}', 'UserController@destroy')->name('users.destroy');

Route::get('/usuario/{name}/{nickname}', 'WelcomeUserController@withNickname');
Route::get('/usuario/{name}', 'WelcomeUserController@withoutNickname');

Route::get('/edad/{age?}', 'WelcomeUserController@age');
