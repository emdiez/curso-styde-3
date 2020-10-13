<?php

Route::get('/', function(){
    return view('welcome');
});

Route::get('/usuarios', 'UserController@index')->name('users');
Route::get('/usuarios/{id}', 'UserController@show')
    ->where('id', '\d+')
    ->name('users.show');
Route::get('/usuarios/nuevo', 'UserController@create')->name('users.create');
Route::get('/usuarios/{id}/edit', 'UserController@edit')
    ->where(['id' => '\d+'])
    ->name('users.edit');

Route::get('/usuario/{name}/{nickname}', 'WelcomeUserController@withNickname');
Route::get('/usuario/{name}', 'WelcomeUserController@withoutNickname');
